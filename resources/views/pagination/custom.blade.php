<div class="pagination">
    @if ($kandidats->onFirstPage())
        <span class="disabled">Previous</span>
    @else
        <a href="{{ $kandidats->previousPageUrl() }}">Previous</a>
    @endif

    @foreach ($kandidats->getUrlRange(1, $kandidats->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="{{ $page == $kandidats->currentPage() ? 'active' : '' }}">
            {{ $page }}
        </a>
    @endforeach

    @if ($kandidats->hasMorePages())
        <a href="{{ $kandidats->nextPageUrl() }}">Next</a>
    @else
        <span class="disabled">Next</span>
    @endif
</div>
