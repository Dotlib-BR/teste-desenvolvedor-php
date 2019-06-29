@if (session()->has('alert'))
    @php
        $alert = session()->get('alert');
    @endphp
    @push('script')
        <script>
            $(document).ready(function() {
                window.{{ $alert['alert'] }}.fire({
                    type: '{{ $alert['type'] }}',
                    title: '{{ $alert['title'] }}',
                    text: '{{ $alert['text'] }}'
                });
            });
        </script>
    @endpush
@endif
