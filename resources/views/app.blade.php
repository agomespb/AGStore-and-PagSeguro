<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ADM | eAGC</title>

        <link rel="shortcut icon" href="{{ url('adm-favicon.ico') }}">

        @section('styles')
                <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
        @show

        <!-- Fonts -->
        {{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <header id="header"><!--header-->

            <!--header_top-->
            @include('partial.top')
            <!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="/"><span><i class="fa fa-adn"></i> ADM-AGCommerce</span></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">

                                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>

                                    @if ( !Auth::guest() )
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-unlock-alt"></i> Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header-middle-->

            <!--header-bottom-->
            @include('partial.bottom_admin')
            <!--/header-bottom-->

        </header>
        <!--/header-->
        <section>

            @yield('content')

        </section>

        <footer id="footer"><!--Footer-->
            @include('partial.footer')
        </footer>
        <!--/Footer-->

        @section('scripts')
            <script src="{{ elixir('js/all.js') }}"></script>
        @show

    </body>
</html>
