<ul class="pagination justify-content-end">
    @if ($pagination['current'] > 1)
        <li class="page-item">
            <a class="page-link" href="{{ request()->url() }}?page={{ $pagination['current'] - 1 }}">Anterior</a>
        </li>
    @endif

    @php
        $start = $pagination['current'] - 2;
        $end   = $pagination['current'] + 2;

        if ($start < 1) {
            $start = 1;
        }

        if ($end > $pagination['total']) {
            $end = $pagination['total'];
        }
    @endphp

    @for ($i = $start; $i <= $end; ++$i)
        @if ($i == $pagination['current'])
            <li class="page-item active">
                <a class="page-link" href="javascript:;">{{ $i }}</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ request()->url() . '?page=' . $i }}">{{ $i }}</a>
            </li>
        @endif
    @endfor

    @if ($pagination['current'] < $pagination['total'])
        <li class="page-item">
            <a class="page-link" href="{{ request()->url() }}?page={{ $pagination['current'] + 1 }}">Próxima</a>
        </li>
    @endif
</ul>
