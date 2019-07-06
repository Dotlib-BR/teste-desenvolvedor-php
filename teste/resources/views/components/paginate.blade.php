<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">

        @for($i = 1; $i <= $pages->last_page; $i ++)
            @if($i === 1)
                <li class="page-item {{ $pages->current_page === $i ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ request()->url().'?'.$params.'&page='.($pages->current_page - 1) }}" tabindex="-1">Anterior</a>
                </li>
            @endif

            <li class="page-item {{ $pages->current_page === $i ? 'active' : '' }}"><a class="page-link" href="{{ request()->url().'?'.$params.'&page='.$i }}">{{ $i }}</a></li>

            @if($pages->last_page == $i)
                <li class="page-item {{ $pages->current_page === $i ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ request()->url().'?'.$params.'&page='.($pages->current_page + 1) }}">Próxima</a>
                </li>
            @endif
        @endfor

    </ul>
</nav>
