<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }} ">
    <!--CSS-DASHBOARD-->
    <link rel="stylesheet" href="{{ asset('css/dashboard/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/weather-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/helper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="{{ route('dashboard') }}">
                            <span>Teste DotLib</span>
                        </a>
                    </div>
                    <li class="label">Menu</li>
                    <ul>
                        <li title="Perfil" {{ request()->routeIs('user.index') ? 'class=active' : '' }}>
                            <a href="{{ route('user.index') }}">
                                <i class="ti-user"></i>
                                <span class="label">Perfil</span>
                            </a>
                        </li>
                        <li title="Minhas Vagas" {{ request()->routeIs('announcement.my.*') ? 'class=active' : '' }}>
                            <a href="{{ route('announcement.my.vacancies') }}">
                                <i class="ti-clipboard"></i>
                                <span class="label">Minhas Vagas</span>
                            </a>
                        </li>
                        <li title="Vagas Disponíveis"
                            {{ request()->routeIs('announcement.index') ? 'class=active' : '' }}>
                            <a href="{{ route('announcement.index') }}">
                                <i class="ti-harddrives"></i>
                                <span class="label">Todas as Vagas</span>
                            </a>
                        </li>
                        @if (auth()->user()->admin)
                            <li title="Anúncios"
                                {{ request()->routeIs('announcement.adm.index') ? 'class=active' : '' }}>
                                <a href="{{ route('announcement.adm.index') }}">
                                    <i class="ti-bookmark"></i>
                                    <span class="label">Anúncios</span>
                                </a>
                            </li>
                            <li title="Usuário" {{ request()->routeIs('user.adm.index') ? 'class=active' : '' }}>
                                <a href="{{ route('user.adm.index') }}"><i class="ti-user"></i><span
                                        class="label">Usuários</span></a>
                            </li>
                        @endif
                    </ul>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">{{ auth()->user()->name }}
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                              document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off"></i>
                                            <span>{{ __('Logout ') }}</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="content-wrap">
        <div class="main" style="height:93vh">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                {{ $title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        {{ $description }}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="main-content">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.nanoscroller.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/sidebar.js') }}"></script>
    <script src="{{ asset('js/dashboard/pace.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/scripts.js') }}"></script>
    <script src="{{ asset('js/dashboard/moment.latest.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/pignose.init.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/weather-init.js') }}"></script>
    <script src="{{ asset('js/dashboard/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/chartist.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/sparkline.init.js') }}"></script>
    <script src="{{ asset('js/dashboard/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/owl.carousel-init.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard2.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.maskMoney.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
function myFunction() {
    document.getElementById('msg').style.display='block'
}
        $(document).ready(() => {

            $('#table_id').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });

            setTimeout(() => {
                $("#msg").fadeOut().empty();
            }, 3000);

            var checkTodos = $("#checkTodos");
            checkTodos.click(function() {
                if ($(this).is(':checked')) {
                    $('input:checkbox').prop("checked", true);
                } else {
                    $('input:checkbox').prop("checked", false);
                }
            })

            $('.delete_checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $(this).closest('tr').addClass('removeRow');
                } else {
                    $(this).closest('tr').removeClass('removeRow');
                }
            });

            $('#delete_all').click(function() {
                var checkbox = $('.delete_checkbox:checked');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if (checkbox.length > 0) {
                    var checkbox_value = [];
                    $(checkbox).each(function() {
                        checkbox_value.push($(this).val());
                    });

                    $.ajax({
                        url: "{{route('announcement.adm.delete.all')}}",
                        method: "POST",
                        data: {
                            _token:CSRF_TOKEN,
                            _method:'DELETE',
                            checkbox_value: checkbox_value
                        },
                        success: function() {

                        },
                    })
                } else {
                    alert('Selecione dados para serema apagados');
                }
            });
        });
    </script>
</body>

</html>
