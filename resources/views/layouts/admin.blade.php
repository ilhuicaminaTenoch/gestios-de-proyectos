<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Gestion | SGC Unilever</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <!-- Scripts -->


</head>
<body class="hold-transition skin-blue sidebar-mini">
<section class="wrapper" id="app">

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>U</b>R</span>
            <!-- logo for regular state and mobile devices -->
            <img src="{{ asset('/images/logoUnilever.png') }}" class="img-thumbnail" alt="..." height="50" width="50">
            <span class="logo-lg"><b>Unilever</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <small class="bg-red">Online</small>
                            <span class="hidden-xs">Jessica MOra </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <p>
                                    Unilever
                                    <small>Planta Tultitlán</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                <a href=" {{route('logout')}}" class="btn btn-default btn-flat" 
                                onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                 </form>
                    </div>
                            
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"></li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Catálogos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/Catalogos/Cat_Puestos"><i class="fa fa-circle-o"></i> Puestos</a></li>
                        <li><a href="/Catalogos/Cat_Empresas"><i class="fa fa-circle-o"></i> Compañias</a></li>
                        <li><a href="/Catalogos/Cat_Usuarios"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Gestion Contratistas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/Catalogos/Cat_Contratistas"><i class="fa fa-circle-o"></i> Contratistas</a></li>
                        <li><a href="/Codigos/Barras"><i class="fa fa-circle-o"></i> Códigos de Acceso</a></li>
                        <li><a href="/Codigos/QR"><i class="fa fa-circle-o"></i> Códigos de Habilidades</a>
                        </li>
                    </ul>
                </li>

               

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Acceso</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/gestion"><i class="fa fa-circle-o"></i> Ingreso </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                        <small class="label pull-right bg-red">PDF</small>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                        <small class="label pull-right bg-yellow">IT</small>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <section class="content-wrapper">
        <!-- Main content -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sistema de Gestion de Contratistas</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>

                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            @yield('contenido')
        </section><!-- /.col -->
    </section><!-- /.row -->

</section><!-- /.content -->
<!--Fin-Contenido-->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 <a href="www.unilever.com.mx">Unilever</a>.</strong> All rights reserved.
</footer>


<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>

<script src="{{asset('js/app.js')}}"></script>


</body>
</html>

