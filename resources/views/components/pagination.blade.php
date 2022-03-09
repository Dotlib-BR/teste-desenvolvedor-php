@props([
    'page' => 0,
    'last_page' => 0
])

<div class="mt-3 mb-3">
    <nav aria-label="Page navigation to the actual resource">
        <ul class="pagination">
            @for ($i = 0; $i < $last_page; $i ++)
                <li class="page-item {{ $i === $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $i === $page ? '#' : Request::fullUrlWithQuery(['page' => $i]) }}">
                        {{ $i + 1 }}
                    </a>
                </li>
            @endfor

            @if ($last_page === 0)
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
