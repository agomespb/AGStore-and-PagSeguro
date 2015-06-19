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

                            <li class="dropdown"><a href="#">ADM-Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('categories') }}"><i class="fa fa-folder"></i> Categorias</a></li>
                                    <li><a href="{{ route('products') }}"><i class="fa fa-coffee"></i> Produtos</a></li>
                                    <li><a href="{{ route('users') }}"><i class="fa fa-users"></i> Usuários</a></li>
                                    <li><a href="{{ route('orders') }}"><i class="fa fa-bolt"></i> Pedidos</a></li>

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