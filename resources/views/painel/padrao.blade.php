<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SOMOS 2 </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

    @yield('css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-black layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav style="background-image:" class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        @if (Auth::user()->tipo != 1)
                            <a href="{{ url('dashboard') }}" class="navbar-brand" style="margin-top: -10px"><img
                                    width="156px" src="{{ url('logoh.png') }}" alt="">
                            @else
                                <a href="{{ url('admin/dashboard') }}" class="navbar-brand"
                                    style="margin-top: -10px"><img width="156px" src="{{ url('logoh.png') }}" alt="">
                        @endif
                        <br>
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i style="color: black" class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->

                    @if (Auth::user()->tipo != 1)

                        @if (Auth::user()->tipo == 0)
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">

                                    <li><a href="{{ url('cliente/combos') }}"><i class="fa fa-plus"></i>
                                            Combos</a></li>
                                    <li><a href="{{ url('produto') }}"><i class="fa fa-shopping-bag"></i>
                                            Produtos</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-users"></i>
                                            Afiliados
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('diretos') }}">DIRETOS</a></li>
                                            <li><a href="{{ url('primeiro') }}">PRIMEIRO</a></li>
                                            <li><a href="{{ url('segundo') }}">SEGUNDO</a></li>
                                            <li><a href="{{ url('terceiro') }}">TERCEIRO</a></li>

                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-dashboard"></i>
                                            <span class="nav-label">Relatorios</span> <span
                                                class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('cliente/vendas') }}">VENDAS</a></li>
                                            <li><a href="{{ url('cliente/pontos') }}">PONTOS</a></li>


                                        </ul>
                                    </li>


                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-dollar"></i>
                                            Financeiro
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('financeiro/geral') }}">GERAL</a></li>
                                            <li><a href="{{ url('cliente/faturas') }}">FATURAS</a></li>
                                            <li><a href="{{ url('cliente/saque') }}">SAQUE</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="{{ url('arquivo') }}"><i class="fa fa-file"></i> Materiais</a>
                                    <li><a href="{{ url('treinamento') }}">
                                            Treinamentos</a>
                                    </li>



                                </ul>

                            </div>
                        @endif

                        @if (Auth::user()->tipo == 2)
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">




                                    <li><a href="{{ url('admin/faturas') }}"><i class="fa fa-plus"></i>
                                            Faturas</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-dollar"></i>
                                            Saques
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('admin/saque') }}">Todos os Saques</a></li>
                                            <li><a href="{{ url('admin/saque/pendentes') }}">Saques Pendentes</a>
                                            </li>
                                            <li><a href="{{ url('admin/saque/ativos') }}">Saques Pagos</a></li>
                                            <li><a href="{{ url('admin/saque/estornados') }}">Saques Estornados</a>
                                            </li>


                                        </ul>
                                    </li>


                                    <li><a href="{{ url('admin/caixa') }}"><i class="fa faq-item"></i> Caixa</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Relatorios
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('admin/relatorios') }}">Relatorio Diario</a></li>
                                            <li><a href="{{ url('admin/relatorioplanos') }}">Relatorio de Planos</a>
                                            </li>
                                            <li><a href="{{ url('admin/niveis') }}">Relatorio de Nivel</a>
                                            </li>
                                            <li><a href="{{ url('admin/logs') }}">Log de Sistema</a></li>



                                        </ul>
                                    </li>





                                </ul>

                            </div>
                        @endif
                        @if (Auth::user()->tipo == 3)
                            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                                <ul class="nav navbar-nav">


                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-users"></i>
                                            Usuarios
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('admin/usuarios') }}">Todos Usuarios</a></li>
                                            <li><a href="{{ url('admin/usuarios/ativos') }}">Ativos</a></li>
                                            <li><a href="{{ url('admin/usuarios/pendentes') }}">Pendentes</a></li>


                                        </ul>
                                    </li>



                                </ul>

                            </div>
                        @endif
                    @else
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="fa fa-users"></i>
                                        Usuarios
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('admin/usuarios') }}">Todos Usuarios</a></li>
                                        <li><a href="{{ url('admin/usuarios/ativos') }}">Ativos</a></li>
                                        <li><a href="{{ url('admin/usuarios/pendentes') }}">Pendentes</a></li>


                                    </ul>
                                </li>

                                <li><a href="{{ url('admin/faturas') }}"><i class="fa fa-plus"></i> Faturas</a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="fa fa-dollar"></i>
                                        Saques
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('admin/saque') }}">Todos os Saques</a></li>
                                        <li><a href="{{ url('admin/saque/pendentes') }}">Saques Pendentes</a></li>
                                        <li><a href="{{ url('admin/saque/ativos') }}">Saques Pagos</a></li>
                                        <li><a href="{{ url('admin/saque/estornados') }}">Saques Estornados</a></li>


                                    </ul>
                                </li>

                                <li><a href="{{ url('admin/caixa') }}"><i class="fa faq-item"></i> Caixa</a></li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        Relatorios
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('admin/relatorios') }}">Relatorio Diario</a></li>
                                        <li><a href="{{ url('admin/relatorioplanos') }}">Relatorio de Planos</a></li>
                                        <li><a href="{{ url('admin/niveis') }}">Relatorio de Nivel</a>
                                        <li><a href="{{ url('admin/premios') }}">Relatorio de Prêmios</a>
                                        <li><a href="{{ url('admin/logs') }}">Log de Sistema</a></li>



                                    </ul>
                                </li>
                                <li><a href="{{ url('admin/energia') }}"><i class="fa faq-item"></i> Energia
                                        Solar</a>
                                </li>

                                <li class="dropdown">

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="fa fa-gear"></i>
                                        Configurações
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('admin/users') }}">Usuarios</a></li>
                                        <li><a href="{{ route('vantagem.index') }}">Beneficios</a></li>
                                        <li><a href="{{ route('plano.index') }}">Planos</a></li>
                                        <li><a href="{{ url('admin/produtos') }}"> Produtos</a></li>
                                        <li><a href="{{ url('admin/extras') }}"> Extras</a></li>
                                        <li><a href="{{ route('metas.index') }}">Metas</a></li>
                                        <li><a href="{{ url('docs') }}">Documentos</a>
                                        </li>
                                        <li><a href="{{ url('admin/treinamentos') }}">Treinamentos</a>
                                        </li>

                                    </ul>
                                </li>




                            </ul>

                        </div>


                    @endif
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{ url('user.jpg') }}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{ url('user.jpg') }}" class="img-circle" alt="">

                                        <p>
                                            {{ Auth::user()->name }}
                                            <small>Membro desde {{ Auth::user()->created_at->format('M-Y') }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ url('minhaconta') }}" class="btn btn-default btn-flat">Minha
                                                Conta</a>
                                        </div>
                                        <div class="pull-right">

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <a class="btn btn-default btn-flat" href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                    <i class="fa fa-sign-out"></i> Sair
                                                </a>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper" style="background-image: url('{{ asset(url('bg.png')) }}');
        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;">
            @yield('content')
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Versão</b> 1.0
                </div>
                <strong>Copyright &copy; 2022 <a href="#">SOMOS</a>.</strong> Todos Diretos Reservados
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://wbot.chat/index.js" token="1e7c1bd562e1c3f6fcc6ee968b86cefe"></script>
    @yield('js')
</body>

</html>
