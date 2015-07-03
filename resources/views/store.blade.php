<!DOCTYPE html>
<html lang="pt-BR">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Confeccionamos moda intima. Calcinhas, sutiãs e conjuntos em renda e algodão.">
        <meta name="keywords" content="lingerie, roupa intima, moda intima, calcinha, calcinhas, sutiãs, sutia">
        <meta name="author" content="http://www.atelierja.com.br/">
        <title>Home | eAGC</title>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="{{ url('loja_favicon.jpg') }}">

        @section('styles')
            <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
        @show

    </head>

    <body>

        <header id="header">
            @include('partial.header')
        </header>

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

        <footer id="footer">
            @include('partial.footer')
        </footer>

        @section('scripts')
            <script src="{{ elixir('js/all.js') }}"></script>
        @show

    </body>
</html>