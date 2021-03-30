@include('include.headerAdmin')

<main>

        @yield('content')

</main>

@section('js', url('js/admin.js'))    
@include('include.footer')
