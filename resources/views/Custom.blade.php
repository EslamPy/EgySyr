@if ($paginator->hasPages())
    <nav class="pagination-wrapper">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>←</span></li>
            @else
            <a href="{{ $paginator->previousPageUrl() }}"><li>←</li></a>
            @endif

            <div class="pagination pagination2">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                            <a href="{{ $url }}"><li>{{ $page }}</li></a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><li>→</li></a>
            @else
                <li class="disabled"><span>→</span></li>
            @endif
        </ul>
    </nav>
@endif
