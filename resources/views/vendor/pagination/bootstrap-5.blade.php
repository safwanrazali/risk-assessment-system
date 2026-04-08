@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="d-flex justify-content-between align-items-center">
        <!-- Previous Button -->
        <div>
            @if ($paginator->onFirstPage())
                <button class="btn btn-sm btn-outline-secondary" disabled>
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-chevron-left"></i> Sebelumnya
                </a>
            @endif
        </div>

        <!-- Page Numbers -->
        <div class="d-flex gap-1 flex-wrap justify-content-center">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="btn btn-sm btn-light disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="btn btn-sm btn-primary" disabled>{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="btn btn-sm btn-outline-primary">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <!-- Next Button -->
        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-sm btn-outline-primary">
                    Seterusnya <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <button class="btn btn-sm btn-outline-secondary" disabled>
                    Seterusnya <i class="bi bi-chevron-right"></i>
                </button>
            @endif
        </div>
    </nav>
@endif
