{{-- Pagination pour la page acheter avec infos détaillées --}}
@if ($paginator->hasPages())
    <div class="shop-pagination">
        {{-- Bouton Précédent --}}
        @if ($paginator->onFirstPage())
            <span class="shop-nav-btn shop-nav-disabled">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="shop-nav-btn" rel="prev" title="Page précédente">‹</a>
        @endif

        {{-- Informations détaillées --}}
        <div class="shop-pagination-info">
            <span class="page-numbers">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
            <span class="total-items">({{ $paginator->total() }} produits)</span>
        </div>

        {{-- Bouton Suivant --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="shop-nav-btn" rel="next" title="Page suivante">›</a>
        @else
            <span class="shop-nav-btn shop-nav-disabled">›</span>
        @endif
    </div>
@endif
