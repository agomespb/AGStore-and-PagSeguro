@extends('store')

@section('sidebar_left')
    @include('store.partial.categories')
@stop

@section('content')

    <h3>
        Teste para PagSeguro:

        @if ( Session::has('transaction') )
            <strong> {{ Session::get('transaction') }}</strong> ?
        @endif

    </h3>

    @if ( Session::has('transactionPost') )

        {{ print_r(Session::get('transactionPost')) }}

    @endif

    <div class="features_items"><!--features_items-->

        <h2 class="title text-center">
            {{ (isset($category_id)) ? $categorias[$category_id] : '' }} Em Destaque
        </h2>
        @include('store.partial.products', ['produtos'=>$produtosEmDestaque])

    </div><!--features_items-->

    <div class="features_items"><!--recommended-->

        <h2 class="title text-center">
            {{ (isset($category_id)) ? $categorias[$category_id] : '' }} Recomendados
        </h2>
        @include('store.partial.products', ['produtos'=>$produtosRecomendados])

    </div><!--recommended-->

@stop