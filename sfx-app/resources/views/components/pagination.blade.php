@if ($paginator->hasPages())
    <nav class="custom-pagination-nav" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-btn pagination-prev disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <span aria-hidden="true">&larr;</span>
                <span>Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn pagination-prev" rel="prev" aria-label="{{ __('pagination.previous') }}">
                <span aria-hidden="true">&larr;</span>
                <span>Previous</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="pagination-numbers">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-ellipsis" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-num active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-num" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn pagination-next" rel="next" aria-label="{{ __('pagination.next') }}">
                <span>Next</span>
                <span aria-hidden="true">&rarr;</span>
            </a>
        @else
            <span class="pagination-btn pagination-next disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <span>Next</span>
                <span aria-hidden="true">&rarr;</span>
            </span>
        @endif
    </nav>
@endif
