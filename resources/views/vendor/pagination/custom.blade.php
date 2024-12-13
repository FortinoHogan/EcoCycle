@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center items-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">&laquo;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-green-600 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-200">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">&raquo;</a>
        @else
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded">&raquo;</span>
        @endif
    </nav>
@endif
