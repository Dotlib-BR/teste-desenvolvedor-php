<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @foreach ($columns as $column => $name)
                    <th scope="col" class="{{ $column == 'name' ? '' : 'text-center' }}">{{ $name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($values as $array)
                <tr onclick="window.location = '{{ route($namespace . '.show', $array['id']) }}'" class="cursor-pointer">
                    @foreach ($array as $column => $value)
                        @switch ($column)
                            @case ('id')
                                @break
                            @case ('price')
                                <td class="text-center">R$ {{ number_format((int)$value, 2, ',', '.') }}</td>
                                @break
                            @default
                                <td class="{{ $column == 'name' ? '' : 'text-center' }}">{{ $value }}</td>
                                @break
                        @endswitch
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
