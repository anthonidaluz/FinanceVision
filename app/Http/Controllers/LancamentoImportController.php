<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lancamento; // Adicionado
use App\Events\LancamentoCreated; // Adicionado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Adicionado
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LancamentoImportController extends Controller
{
    /**
     * Exibe a página de upload do extrato.
     */
    public function index()
    {
        return view('lancamentos.importar');
    }

    /**
     * Processa o ficheiro CSV enviado, envia para a IA e redireciona para a revisão.
     */
    public function processar(Request $request)
    {
        $request->validate([
            'extrato' => 'required|file|mimes:csv,txt,plain|max:2048',
        ]);

        $file = $request->file('extrato');
        $content = file_get_contents($file->getRealPath());
        $lines = explode("\n", $content);
        $csvSample = implode("\n", array_slice($lines, 0, 20));
        $userCategories = Auth::user()->categories()->pluck('name')->implode(', ');
        $prompt = $this->criarPrompt($csvSample, $userCategories);

        try {
            $apiKey = config('gemini.api_key');
            $endpoint = config('gemini.endpoint');

            $response = Http::timeout(60)->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$endpoint}?key={$apiKey}", [
                        'contents' => [['parts' => [['text' => $prompt]]]]
                    ]);

            if (!$response->successful()) {
                $errorDetails = $response->json('error.message', 'Erro desconhecido da API.');
                return back()->with('error', "A API de IA falhou: " . $errorDetails);
            }

            $jsonResponse = $response->json();
            $iaRawText = $jsonResponse['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (is_null($iaRawText)) {
                return back()->with('error', 'A IA devolveu uma resposta vazia. Verifique o seu ficheiro CSV.');
            }

            $jsonString = $this->limparRespostaJson($iaRawText);
            $parsedData = json_decode($jsonString, true);

            session()->flash('import_data', $parsedData['lancamentos'] ?? []);
            return redirect()->route('lancamentos.importar.revisar');

        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro na ligação com a API: ' . $e->getMessage());
        }
    }

    /**
     * Exibe a página de revisão com os dados da IA.
     */
    public function revisar()
    {
        $importData = session('import_data');

        if (empty($importData)) {
            return redirect()->route('lancamentos.importar')->with('error', 'Nenhuns dados para importar. Por favor, envie o ficheiro novamente.');
        }

        $userCategories = Auth::user()->categories()->orderBy('name')->get();

        return view('lancamentos.revisar', [
            'lancamentos' => $importData,
            'categories' => $userCategories
        ]);
    }

    /**
     * Salva os dados revistos pelo utilizador.
     */
    public function salvar(Request $request)
    {
        $validated = $request->validate([
            'lancamentos' => 'required|array',
            'lancamentos.*.data' => 'required|date',
            'lancamentos.*.descricao' => 'required|string|max:255',
            'lancamentos.*.valor' => 'required|numeric',
            'lancamentos.*.tipo' => 'required|in:receita,despesa',
            'lancamentos.*.category_id' => 'nullable|exists:categories,id',
        ]);

        $user = Auth::user();

        DB::transaction(function () use ($validated, $user) {
            foreach ($validated['lancamentos'] as $dadosLancamento) {
                $lancamento = $user->lancamentos()->create([
                    'description' => $dadosLancamento['descricao'],
                    'amount' => abs($dadosLancamento['valor']),
                    'type' => $dadosLancamento['tipo'],
                    'date' => $dadosLancamento['data'],
                    'category_id' => $dadosLancamento['category_id'],
                ]);
                LancamentoCreated::dispatch($lancamento);
            }
        });

        return redirect()->route('lancamentos.index')->with('success', count($validated['lancamentos']) . ' lançamentos importados com sucesso!');
    }


    /**
     * Cria o prompt detalhado para a API do Gemini.
     */
    private function criarPrompt(string $csvSample, string $userCategories): string
    {
        return <<<PROMPT
Você é um assistente financeiro especialista em análise de extratos bancários .csv.
A sua tarefa é analisar as primeiras 20 linhas de um extrato .csv e convertê-lo num JSON limpo.

REGRAS OBRIGATÓRIAS:
1.  **Formato de Saída:** A sua resposta deve ser APENAS o objeto JSON. Não inclua "```json" ou qualquer texto introdutório.
2.  **Mapeamento de Colunas:** Analise o cabeçalho e os dados de amostra para identificar automaticamente as colunas de "data", "descrição" e "valor".
3.  **Identificação de Tipo:** Determine se cada linha é 'receita' ou 'despesa'. Se o valor for positivo, é 'receita'. Se for negativo, é 'despesa'. Se for um extrato de cartão de crédito onde todos os valores são positivos, assuma que são 'despesa'.
4.  **Formato de Data:** Normalize todas as datas para o formato 'AAAA-MM-DD'.
5.  **Formato de Valor:** Normalize todos os valores para um número decimal (float), removendo 'R$', '€', ',' etc. Use o sinal de menos (ex: -25.50) para despesas.
6.  **Sugestão de Categoria:** Com base na descrição, sugira uma categoria. As categorias preferenciais do utilizador são: [{$userCategories}]. Se não se encaixar, use categorias genéricas (ex: Alimentação, Transporte, Moradia, Lazer, Outros).

DADOS DE AMOSTRA DO CSV:
---
{$csvSample}
---

RESPONDA APENAS COM UM JSON neste formato:
{
  "lancamentos": [
    {
      "data": "AAAA-MM-DD",
      "descricao": "Descrição da Transação",
      "valor": 1500.00 (para receitas) ou -45.20 (para despesas),
      "tipo": "receita" ou "despesa",
      "categoria_sugerida": "Salário" (ou "Alimentação", etc.)
    }
  ]
}
PROMPT;
    }

    /**
     * Limpa a resposta da IA, removendo ```json e ```
     */
    private function limparRespostaJson(string $rawText): string
    {
        return str_replace(['```json', '```'], '', trim($rawText));
    }
}