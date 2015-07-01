<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="AGomes">
        <title>Home | eAGC</title>

        <link rel="shortcut icon" href="{{ url('loja_favicon.jpg') }}">

        @section('styles')
            <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
        @show

    </head>
    <!--/head-->

    <body>

        <header id="header"><!--header-->
            @include('partial.header')
        </header>
        <!--/header-->

        <section>

            <div class="container">
                <div class="row">

                    @yield('cart_content')

                    <div class="col-sm-3">
                        @yield('sidebar_left')
                    </div>

                    <div class="col-sm-9 padding-right">
                        @yield('content')
                    </div>

                </div>
            </div>

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