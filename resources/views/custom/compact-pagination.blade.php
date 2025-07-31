{{-- Pagination compacte personnalisée --}}
@if ($paginator->hasPages())
    <div class="compact-pagination">
        {{-- Bouton Précédent --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-btn pagination-btn-disabled">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn" rel="prev">‹</a>
        @endif

        {{-- Informations sur la page --}}
        <span class="pagination-info">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        {{-- Bouton Suivant --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn" rel="next">›</a>
        @else
            <span class="pagination-btn pagination-btn-disabled">›</span>
        @endif
    </div>
@endif
