@include('include.header')

<main class="logged__main">

        @yield('content')

</main>
@section('utilities', url('js/utilities.js'))
@section('js', url('js/user.js'))
@include('include.footer')
