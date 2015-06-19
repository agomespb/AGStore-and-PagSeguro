<div class="header-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/" class="active">Home</a></li>

                        <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">

                                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> Carrinho</a></li>

                                @if (Auth::guest())
                                    <li><a href="{{ url('/auth/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="{{ url('/auth/register') }}"><i class="fa fa-anchor"></i> Register</a></li>
                                @else
                                    <li><a href="{{ route('checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-unlock-alt"></i> Logout</a></li>
                                @endif

                            </ul>
                        </li>

                        <li><a href="{{ route('contact') }}">Contato</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <input type="text" placeholder="Buscar"/>
                </div>
            </div>
        </div>
    </div>
</div>