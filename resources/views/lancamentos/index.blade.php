@extends('layouts.app')

@section('header')
    Meus Lançamentos
@endsection

@push('styles')
    <style>
        /* Estilos para o seletor de Tipo (Receita/Despesa) */
        .entry-type-toggle input[type="radio"]:checked+label {
            transition: all 0.2s ease-in-out;
        }

        #receita:checked+label {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        #despesa:checked+label {
            background-color: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }

        /* ### CSS DE PAGINAÇÃO ADICIONADO ### */
        /* Estiliza os links gerados pelo Bootstrap para o nosso design */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 0.5rem;
        }

        .page-item .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            /* 8px */
            border: 1px solid #e2e8f0;
            /* border-gray-200 */
            background-color: #fff;
            color: #4a5568;
            /* text-gray-700 */
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .page-item .page-link:hover {
            background-color: #f7fafc;
            /* bg-gray-50 */
        }

        .page-item.active .page-link {
            background-color: #3498DB;
            /* bg-primary */
            border-color: #3498DB;
            color: #fff;
            z-index: 1;
        }

        .page-item.disabled .page-link {
            color: #a0aec0;
            /* text-gray-400 */
            background-color: #f7fafc;
            /* bg-gray-50 */
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        /* Esconde os textos "Previous" e "Next" */
        .page-link[rel="prev"] span,
        .page-link[rel="next"] span {
            display: none;
        }

        /* Mostra os ícones de seta */
        .page-link[rel="prev"]::before {
            content: '«';
        }

        .page-link[rel="next"]::before {
            content: '»';
        }
    </style>
@endpush

@section('content')
    <div class="space-y-10">

        {{-- Feedback --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Formulário (O seu código original, intacto) --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-6 pb-4 border-b">💰 Adicionar Novo Lançamento</h3>

            <form action="{{ route('lancamentos.store') }}" method="POST" x-data="{ type: '{{ old('type', 'receita') }}' }">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Tipo --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                        <div class="entry-type-toggle flex rounded-lg border border-gray-300 overflow-hidden">
                            <input @click="type = 'receita'" type="radio" id="receita" name="type" value="receita"
                                class="hidden" {{ old('type', 'receita') == 'receita' ? 'checked' : '' }}>
                            <label for="receita"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold flex items-center justify-center gap-2 text-gray-600">
                                <i class="fa-solid fa-arrow-up"></i> Receita
                            </label>
                            <input @click="type = 'despesa'" type="radio" id="despesa" name="type" value="despesa"
                                class="hidden" {{ old('type', 'receita') == 'despesa' ? 'checked' : '' }}>
                            <label for="despesa"
                                class="flex-1 text-center py-2 px-4 cursor-pointer font-semibold border-l border-gray-300 flex items-center justify-center gap-2 text-gray-600">
                                <i class="fa-solid fa-arrow-down"></i> Despesa
                            </label>
                        </div>
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descrição</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="Ex: Salário, Supermercado">
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Valor --}}
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Valor</label>
                        <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount') }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="150.75">
                        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Data --}}
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">Data</label>
                        <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                        @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Categoria --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
                        <select id="category_id" name="category_id"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                            <option value="">Nenhuma</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Meta (COM A LÓGICA DE BLOQUEIO) --}}
                    <div>
                        <label for="meta_id" class="block text-sm font-semibold text-gray-700 mb-2">Vincular a Meta (Apenas
                            Receitas)</label>
                        <select id="meta_id" name="meta_id"
                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:ring-primary focus:border-primary transition-colors disabled:bg-gray-100 disabled:opacity-70"
                            :disabled="type === 'despesa'">
                            <option value="">Nenhuma</option>
                            @foreach ($metas as $meta)
                                <option value="{{ $meta->id }}" {{ old('meta_id') == $meta->id ? 'selected' : '' }}>
                                    {{ $meta->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Botões --}}
                    <div class="flex flex-wrap justify-end items-center gap-4 mt-6 md:col-span-full">
                        <button type="button" disabled
                            class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-500 font-semibold rounded-lg shadow-sm cursor-not-allowed hover:bg-gray-300 transition">
                            <i class="fa-solid fa-file-import mr-2"></i>
                            Importar Extrato
                        </button>

                        <button type="submit"
                            class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition">
                            <i class="fa-solid fa-check mr-2"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Tabela de Histórico --}}
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 tracking-tight mb-6">📁 Histórico de Lançamentos</h3>

            {{-- ### O CÓDIGO DA PAGINAÇÃO AJAX COMEÇA AQUI ### --}}
            <div id="historico-container" x-data="{
                        async loadPage(url) {
                            try {
                                const response = await fetch(url, { 
                                    headers: { 
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    } 
                                });
                                if (!response.ok) throw new Error('Erro ao carregar página.');
                                const html = await response.text();
                                this.$root.innerHTML = html; // Substitui o conteúdo do div 'historico-container'
                            } catch (error) {
                                console.error('Falha na paginação AJAX:', error);
                            }
                        }
                    }">
                {{-- Carrega a tabela parcial pela primeira vez --}}
                @include('lancamentos.partials.historico-tabela', ['lancamentos' => $lancamentos])
            </div>
            {{-- ### FIM DO CÓDIGO DA PAGINAÇÃO AJAX ### --}}
        </div>
    </div>
@endsection