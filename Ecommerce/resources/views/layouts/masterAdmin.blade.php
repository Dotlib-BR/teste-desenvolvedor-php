@include('include.headerAdmin')

<main class="admin__wrapper">

        @yield('content')

</main>

@section('js', url('js/admin.js'))    
@include('include.footer')
