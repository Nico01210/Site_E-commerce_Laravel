{{-- Pagination ultra-minimaliste (flèches seulement) --}}
@if ($paginator->hasPages())
    <div class="minimal-pagination">
        {{-- Bouton Précédent --}}
        @if ($paginator->onFirstPage())
            <span class="nav-btn nav-btn-disabled">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="nav-btn" rel="prev" title="Page précédente">‹</a>
        @endif

        {{-- Bouton Suivant --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nav-btn" rel="next" title="Page suivante">›</a>
        @else
            <span class="nav-btn nav-btn-disabled">›</span>
        @endif
    </div>
@endif
