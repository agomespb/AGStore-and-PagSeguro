
<!--header-middle-->
<div class="header-middle">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo pull-left">
                    <a href="/"><img src="{{ asset('images/logo.jpg') }}" class="img-responsive"></a>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="shop-menu pull-right">
                    <ul class="nav navbar-nav">

                        <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> {{ prime_name('Carrinho') }}</a></li>

                        @if (Auth::guest())
                            <li><a href="{{ url('/auth/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            <li><a href="{{ url('/auth/register') }}"><i class="fa fa-anchor"></i> Register</a></li>
                        @else
                            <li><a href="{{ route('checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">{{ prime_name(Auth::user()->name) }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-unlock-alt"></i> Logout</a></li>
                                    <li class=""></li>
                                    <li><a href="{{ route('user_index') }}"><i class="fa fa-user"></i> Minha conta</a></li>
                                </ul>
                            </li>
                        @endif

                        @if(Auth::check() && Auth::user()->is_admin)
                            <li><a href="{{ route('categories') }}"><i class="fa fa-code"></i> Área Restrito</a></li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/header-middle-->

