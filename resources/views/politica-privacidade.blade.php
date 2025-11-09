<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Política de Privacidade - {{ config('app.name', 'Finance Vision') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- Cabeçalho/Navegação --}}
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <nav class="flex justify-between items-center max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <a href="/" class="flex items-center gap-2">
                <span class="font-bold text-2xl" style="color:#3498db;">
                    Finance Vision
                </span>

            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-[#3498db]">Entrar</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-[#3498db] text-white text-sm font-semibold rounded-lg shadow-sm hover:bg-[#1e74c8] transition-colors">
                    Começar Gratuitamente
                </a>
            </div>
        </nav>
    </header>

    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Política de Privacidade</h1>
                            <p class="text-sm text-gray-500 mt-1">Atualizado em 06 de novembro de 2025</p>
                        </div>
                        <div class="text-sm text-right text-gray-600">
                            <div class="font-medium">Suporte</div>
                            <div class="mt-1">contato@financevision.com</div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-100">

                    <div class="space-y-6 text-gray-700">
                        <section>
                            <h2 class="font-semibold text-gray-900">O que coletamos</h2>
                            <p class="text-sm mt-2">Dados essenciais para o funcionamento: conta (nome, e‑mail),
                                lançamentos (descrição, valor, data, categoria), metas, categorias, relatórios gerados e
                                dados técnicos (IP, device). Arquivos importados (CSV) são processados temporariamente.
                            </p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Como usamos</h2>
                            <p class="text-sm mt-2">Para armazenar e exibir seus lançamentos, gerar relatórios e
                                previsões, processar importações, gerenciar metas e gamificação (conquistas, pontos) e
                                enviar comunicações transacionais.</p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Compartilhamento</h2>
                            <p class="text-sm mt-2">Compartilhamos apenas com provedores essenciais (ex.: login social,
                                serviços de IA para categorização, provedores de e‑mail). Terceiros seguem contratos de
                                confidencialidade e segurança.</p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Segurança</h2>
                            <p class="text-sm mt-2">Senhas hashed; conexões via TLS; controle de acesso; monitoramento.
                                Em caso de incidente relevante, notificaremos usuários afetados conforme legislação.</p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Retenção</h2>
                            <p class="text-sm mt-2">Mantemos seus dados enquanto a conta existir ou conforme exigência
                                legal. Você pode solicitar exclusão completa dos dados.</p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Seus direitos</h2>
                            <p class="text-sm mt-2">Atualizar perfil, exportar dados (CSV/JSON quando disponível),
                                apagar itens (lançamentos, metas, categorias) e solicitar exclusão total da conta.</p>
                        </section>

                        <section>
                            <h2 class="font-semibold text-gray-900">Cookies</h2>
                            <p class="text-sm mt-2">Utilizamos cookies e storage local para sessões, preferências e
                                métricas anônimas.</p>
                        </section>
                    </div>

                    <div class="mt-8">
                        <div class="max-w-4xl mx-auto px-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="text-left">
                                    <a class="text-sm text-primary hover:underline" href="{{ url('/') }}">Voltar</a>
                                </div>

                                <div class="flex flex-wrap items-center gap-3 justify-start sm:justify-end">
                                    <a href="{{ url('/sobre-nos') }}"
                                        class="px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm hover:shadow">
                                        Sobre Nós
                                    </a>

                                    <a href="{{ url('/perguntas-frequentes') }}"
                                        class="px-3 py-2 bg-primary text-white rounded-lg text-sm hover:opacity-95">
                                        Perguntas Frequentes
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name', 'Finance Vision') }}
        </div>
    </footer>

</body>

</html>