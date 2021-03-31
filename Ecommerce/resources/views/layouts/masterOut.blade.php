@include('include.headerOut')

<main class="wrapper__auth">

        @yield('content')

</main>
@section('utilities', url('js/utilities.js'))
@include('include.footer')
