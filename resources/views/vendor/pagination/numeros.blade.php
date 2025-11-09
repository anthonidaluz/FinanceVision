@if ($paginator->hasPages())
    <nav class="mt-6 flex justify-center">
        <ul class="pagination inline-flex items-center gap-2">
            {{-- Botão anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link px-3 py-2 text-gray-400 bg-gray-100 rounded cursor-not-allowed">«</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition"
                        href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a>
                </li>
            @endif

            {{-- Botões de página --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link px-3 py-2 text-gray-400 bg-gray-100 rounded">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link px-3 py-2 font-semibold text-white bg-blue-600 rounded shadow">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botão próximo --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition"
                        href="{{ $paginator->nextPageUrl() }}" rel="next">»</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link px-3 py-2 text-gray-400 bg-gray-100 rounded cursor-not-allowed">»</span>
                </li>
            @endif
        </ul>
    </nav>
@endif