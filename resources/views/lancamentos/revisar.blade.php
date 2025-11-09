@extends('layouts.app')

@section('header')
    Revisar Importação
@endsection

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10" x-data="{ 
                    showModal: false,
                    newCat: { name: '', icon: '', color: '#3498DB' },
                    isSaving: false,
                    async saveCategory() {
                        this.isSaving = true;
                        try {
                            const response = await fetch('{{ route('categorias.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(this.newCat)
                            });

                            if (!response.ok) throw new Error('Erro ao criar');
                            const category = await response.json();

                            document.querySelectorAll('.category-select').forEach(select => {
                                const option = new Option(category.name, category.id);
                                select.add(option);
                            });

                            this.showModal = false;
                            this.newCat = { name: '', icon: '', color: '#3498DB' };

                            if (typeof toastr !== 'undefined') {
                                toastr.success('Categoria ' + category.name + ' criada!', 'Sucesso');
                            } else {
                                alert('Categoria criada com sucesso!');
                            }
                        } catch (e) {
                            alert('Erro ao criar categoria. Por favor, verifique os dados.');
                        } finally {
                            this.isSaving = false;
                        }
                    }
                 }">

        <!-- Cabeçalho -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-800 tracking-tight">Revisar Lançamentos</h2>
            <p class="mt-3 text-lg text-gray-600">
                Nossa <span class="font-semibold text-primary">IA financeira</span> analisou o seu extrato. Revise e
                confirme.
            </p>
        </div>

        <!-- Conteúdo -->
        <form action="{{ route('lancamentos.importar.salvar') }}" method="POST">
            @csrf

            @if (!empty($lancamentos) && count($lancamentos) > 0)
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead
                                class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-600 uppercase tracking-wider text-xs font-semibold">
                                <tr>
                                    <th class="px-5 py-4 text-left">Data</th>
                                    <th class="px-5 py-4 text-left">Descrição</th>
                                    <th class="px-5 py-4 text-left">Valor</th>
                                    <th class="px-5 py-4 text-left" style="min-width: 260px;">Categoria</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach ($lancamentos as $index => $lancamento)
                                    @continue(empty($lancamento['data']) || empty($lancamento['descricao']) || !isset($lancamento['valor']))
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <input type="hidden" name="lancamentos[{{ $index }}][data]"
                                            value="{{ $lancamento['data'] }}">
                                        <input type="hidden" name="lancamentos[{{ $index }}][tipo]"
                                            value="{{ $lancamento['tipo'] }}">

                                        <td class="px-5 py-3 whitespace-nowrap text-gray-600 font-medium">
                                            {{ \Carbon\Carbon::parse($lancamento['data'])->format('d/m/Y') }}
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <input type="text" name="lancamentos[{{ $index }}][descricao]"
                                                value="{{ $lancamento['descricao'] }}"
                                                class="w-full rounded-lg border-gray-200 focus:ring-primary/50 focus:border-primary text-sm text-gray-800">
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-gray-400 mr-1">R$</span>
                                                <input type="number" step="0.01" name="lancamentos[{{ $index }}][valor]"
                                                    value="{{ $lancamento['valor'] }}"
                                                    class="w-28 rounded-lg border-gray-200 focus:ring-primary/50 focus:border-primary text-sm font-semibold {{ ($lancamento['valor'] ?? 0) > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <div class="flex gap-2">
                                                @php
                                                    $suggested_name = strtolower($lancamento['categoria_sugerida'] ?? '');
                                                    $suggested_id = null;
                                                    $match_found = false;
                                                    if (!empty($suggested_name)) {
                                                        foreach ($categories as $category) {
                                                            if (str_contains(strtolower($category->name), $suggested_name) || str_contains($suggested_name, strtolower($category->name))) {
                                                                $suggested_id = $category->id;
                                                                $match_found = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <select name="lancamentos[{{ $index }}][category_id]"
                                                    class="category-select block w-full rounded-lg border-gray-200 focus:ring-primary/50 focus:border-primary text-sm text-gray-700 bg-white">
                                                    <option value="">— Nenhuma —</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected($category->id == $suggested_id)>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="button" @click="showModal = true"
                                                    class="flex-shrink-0 inline-flex items-center justify-center w-10 h-10 bg-primary/10 text-primary rounded-lg hover:bg-primary hover:text-white transition"
                                                    title="Nova Categoria">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                            @if (!$match_found && !empty($suggested_name))
                                                <div class="mt-2 text-xs text-gray-500">
                                                    Sugestão IA: <span
                                                        class="font-semibold text-primary">{{ $lancamento['categoria_sugerida'] }}</span>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="flex items-center justify-end gap-4 mt-10">
                    <a href="{{ route('lancamentos.importar') }}"
                        class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-100 transition text-sm">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition text-sm">
                        <i class="fa-solid fa-check mr-2"></i> Confirmar Importação
                    </button>
                </div>
            @else
                <!-- Estado vazio -->
                <div class="bg-white text-center p-14 rounded-2xl shadow-lg border border-gray-100">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300 mb-5"></i>
                    <h3 class="text-2xl font-semibold text-gray-700">Nenhum dado para importar</h3>
                    <a href="{{ route('lancamentos.importar') }}"
                        class="mt-6 inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary/90 transition text-sm">
                        <i class="fa-solid fa-upload mr-2"></i> Tentar Novamente
                    </a>
                </div>
            @endif
        </form>

        {{-- ### MODAL AJAX DE CRIAÇÃO DE CATEGORIA ### --}}
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak>
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="showModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full"
                    x-transition:enter="            <div class=" inline-block align-bottom bg-white rounded-2xl text-left
                    overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95">

                    <div class="bg-white px-6 pt-6 pb-4">
                        <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4">Criar Categoria</h3>

                        <!-- Formulário do modal -->
                        <form @submit.prevent="saveCategory">
                            <div class="space-y-4">
                                <!-- Nome -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                    <input type="text" x-model="newCat.name" required
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                        placeholder="Ex: Farmácia">
                                </div>

                                <!-- Ícone e Cor -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Ícone</label>
                                        <div class="grid grid-cols-4 gap-2">
                                            @foreach(['fa-house', 'fa-car', 'fa-utensils', 'fa-cart-shopping', 'fa-heart-pulse', 'fa-plane', 'fa-graduation-cap', 'fa-bolt'] as $icon)
                                                <button type="button" @click="newCat.icon = 'fa-solid {{ $icon }}'"
                                                    :class="newCat.icon === 'fa-solid {{ $icon }}' ? 'bg-primary text-white ring-2 ring-offset-2 ring-primary' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                                                    class="flex items-center justify-center h-10 w-10 rounded-lg transition-all">
                                                    <i class="fa-solid {{ $icon }}"></i>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Cor</label>
                                        <input type="color" x-model="newCat.color"
                                            class="block w-full h-12 rounded-lg border-gray-300 shadow-sm p-1 cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            <!-- Botões -->
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" @click="showModal = false"
                                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 flex items-center transition"
                                    :disabled="isSaving">
                                    <span x-show="isSaving" class="mr-2"><i class="fa-solid fa-spinner fa-spin"></i></span>
                                    <span x-text="isSaving ? 'Salvando...' : 'Criar Categoria'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- FIM DO MODAL --}}
    </div>
@endsection