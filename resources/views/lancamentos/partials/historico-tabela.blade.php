{{-- NOVO FICHEIRO: resources/views/lancamentos/partials/historico-tabela.blade.php --}}

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider text-xs">
            <tr>
                <th class="px-6 py-3 text-left font-semibold">Descrição</th>
                <th class="px-6 py-3 text-left font-semibold">Data</th>
                <th class="px-6 py-3 text-left font-semibold">Valor</th>
                <th class="px-6 py-3 text-right font-semibold">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
            @forelse ($lancamentos as $lancamento)
                <tr class="hover:bg-gray-50 transition">
                    {{-- Célula Descrição --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 flex-shrink-0">
                                @if($lancamento->category && $lancamento->category->icon)
                                    <i class="{{ $lancamento->category->icon }} text-lg"
                                        style="color: {{ $lancamento->category->color ?? '#6c757d' }}"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $lancamento->description }}</div>
                                <div class="text-xs text-gray-500">
                                    @if($lancamento->category)
                                        <span class="font-semibold">{{ $lancamento->category->name }}</span>
                                    @endif
                                    @if($lancamento->meta)
                                        <span class="ml-2 italic opacity-75">→ {{ $lancamento->meta->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    {{-- Célula Data --}}
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                        {{ \Carbon\Carbon::parse($lancamento->date)->format('d/m/Y') }}
                    </td>
                    {{-- Célula Valor --}}
                    <td
                        class="px-6 py-4 whitespace-nowrap font-semibold {{ $lancamento->type == 'receita' ? 'text-green-600' : 'text-red-500' }}">
                        {{ $lancamento->type == 'receita' ? '+' : '-' }} R$
                        {{ number_format($lancamento->amount, 2, ',', '.') }}
                    </td>
                    {{-- Célula Ações (Os botões de Editar/Excluir agora funcionam) --}}
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('lancamentos.edit', $lancamento) }}"
                                class="text-blue-600 hover:text-blue-800 transition" title="Editar">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('lancamentos.destroy', $lancamento) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este lançamento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        Nenhum lançamento encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- LINKS DE PAGINAÇÃO (AGORA COM O @click.prevent para o AJAX) --}}
<div class="mt-6 px-1" @click.prevent="
    const link = $event.target.closest('a');
    if (link?.href && !link.classList.contains('disabled')) {
        loadPage(link.href);
    }
">
    {{-- Renderiza a paginação com tema Bootstrap 5 --}}
    {!! $lancamentos->links('pagination::numeros') !!}
</div>