<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($values as $array)
                <tr onclick="window.location = '{{ route($namespace . '.show', $array['id']) }}'" class="cursor-pointer">
                    @foreach ($array as $key => $value)
                        @if ($key == 'id')
                            @continue
                        @endif
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
