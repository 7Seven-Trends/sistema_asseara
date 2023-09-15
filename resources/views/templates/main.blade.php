@php
    
    $usuario = \App\Models\Usuario::find(session()->get('usuario')['id']);
    
@endphp

<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="utf-8" />
    <title>Painel Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Painel Administrativo" name="description" />
    <meta content="7Seven" name="author" />
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('styles')
    @livewireStyles
    @toastr_css
    @stack('styles')
</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('painel.index') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo_instituicao_mobile.png') }}" alt=""
                                    width="100">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo_instituicao.png') }}" alt="" width="100">
                            </span>
                        </a>

                        <a href="{{ route('painel.index') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('images/logo_instituicao_mobile.png') }}" alt=""
                                    style="max-width: 25px;">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('images/logo_instituicao.png') }}" alt="" width="100">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ session()->get('usuario')['nome'] }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item text-danger" href="{{ route('painel.sair') }}"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                    key="t-logout">Sair</span></a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled mt-3" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class='bx bx-desktop'></i>
                                <span key="t-dashboards">Institucional</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('painel.convenios') }}" key="t-default">Convênios</a></li>
                                <li><a href="{{ route('painel.eventos') }}" key="t-default">Eventos</a></li>
                                <li><a href="{{ route('painel.noticias') }}" key="t-default">Noticias</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class='bx bx-user'></i>
                                <span key="t-dashboards">Associados</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('painel.associados') }}" key="t-default">Associados</a></li>
                                <li><a href="{{ route('painel.servicos') }}" key="t-default">Serviços</a></li>
                            </ul>
                        </li>



                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class='bx bx-image'></i>
                                <span key="t-dashboards">Banners</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('painel.banners') }}" key="t-default">Principal</a></li>
                                <li><a href="{{ route('painel.banners.cursos') }}" key="t-default">Cursos</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class='bx bx-briefcase-alt-2'></i>
                                <span key="t-dashboards">Administração</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('painel.usuarios') }}" key="t-default">Usuários</a></li>
                                <li><a href="{{ route('painel.mensagens.suporte') }}" key="t-default">Suporte</a>
                                </li>
                                <li><a href="{{ route('painel.newsletter') }}" key="t-default">Newsletter</a></li>
                                {{-- <li><a href="{{ route('painel.notificacao') }}" key="t-default">Log de
                                        Notificação</a>
                                </li> --}}
                            </ul>
                        </li>


                        <li>
                            <a href="{{ route('painel.hotsites') }}" class="waves-effect">
                                <i class='bx bx-fullscreen'></i>
                                <span key="t-dashboards">Hotsites de Captura</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <div class="col-6 text-start">
                                    <h4 class="mb-sm-0 font-size-18">@yield('titulo')</h4>
                                </div>
                                <div class="col-6 text-end">
                                    @yield('botoes')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @yield('conteudo')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by 7 Seven Trends
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    @toastr_js
    @toastr_render
    @livewireScripts
    <!-- dashboard init -->
    {{-- <script src="{{asset('js/pages/dashboard.init.js')}}"></script> --}}

    <!-- App js -->
    @yield('scripts')
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.addEventListener('notificaToastr', event => {
            if (event.detail.tipo == 'success') {
                toastr.success(event.detail.mensagem);
            } else if (event.detail.tipo == 'error') {
                toastr.error(event.detail.mensagem);
            }
        });
    </script>
</body>

</html>
