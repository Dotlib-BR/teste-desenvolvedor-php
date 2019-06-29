@if ($type == 'statistic')
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="media d-flex">
                    <div class="align-self-center">
                        <i class="fas fa-{{ $icon }} fa-3x"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3>{{ $total }}</h3>
                        <span>{{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
@endif
