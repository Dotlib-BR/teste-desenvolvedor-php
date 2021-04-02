@include('include.headerAdmin')

<main class="admin__wrapper">

        @yield('content')

</main>
@section('utilities', url('js/utilities.js'))
@section('js', url('js/admin.js'))    
@include('include.footerAdmin')
