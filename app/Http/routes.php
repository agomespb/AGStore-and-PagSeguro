<?php


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*
|--------------------------------------------------------------------------
| Ambiente da Loja!!!
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => '/', 'where' => ['id'=>'[0-9]+']], function() {

    Route::get('', ['as' => 'index', 'uses' => 'Store\StoreController@index']);

    Route::get('contact', ['as' => 'contact', 'uses' => 'Store\ContactController@getContact']);

    Route::post('contact', ['as' => 'contact_create', 'uses' => 'Store\ContactController@postContact']);

    Route::get('category/{id}/products', ['as' => 'index_category', 'uses' => 'Store\StoreController@indexCategory']);

    Route::get('product/{id}/show', ['as' => 'product_show', 'uses' => 'Store\StoreController@productShow']);

    Route::get('tag/{id}/products', ['as' => 'tag_products', 'uses' => 'Store\StoreController@tagProducts']);

    Route::get('ps', ['as' => 'get_ps_transaction', 'uses' => 'Store\StoreController@getPagSeguroTransaction']);

    Route::post('ps', ['as' => 'post_ps_transaction', 'uses' => 'Store\StoreController@postPagSeguroTransaction']);

});

Route::group(['prefix' => 'cart', 'middleware'=>'verify.address', 'where' => ['id'=>'[0-9]+']], function() {

    Route::get('', ['as' => 'cart', 'uses' => 'Store\CartController@index']);

    Route::get('product/{id}/add', ['as' => 'cart_add', 'uses' => 'Store\CartController@add']);

    Route::get('product/{id}/minus', ['as' => 'cart_minus', 'uses' => 'Store\CartController@minus']);

    Route::get('product/destroy/{id}', ['as' => 'cart_destroy', 'uses' => 'Store\CartController@destroy']);

});

Route::group(['prefix' => 'checkout', 'middleware'=>'verify.address', 'where' => ['id'=>'[0-9]+']], function() {

    Route::get('', ['as' => 'checkout', 'uses' => 'Store\CheckoutController@checkout']);

    Route::get('order', ['as' => 'checkout_place', 'uses' => 'Store\CheckoutController@place']);

});

Route::group(['prefix' => 'user', 'middleware'=>'auth', 'where' => ['id'=>'[0-9]+']], function(){


    Route::get('', ['as' => 'user_index', 'uses' => 'User\AccountController@index']);

    Route::get('address/create', ['as' => 'user_address_create', 'uses' => 'User\AddressController@create']);

    Route::post('address/store', ['as' => 'user_address_store', 'uses' => 'User\AddressController@store']);

    Route::get('address/destroy/{id}', ['as' => 'user_address_destroy', 'uses' => 'User\AddressController@destroy']);

});

/*
|--------------------------------------------------------------------------
| ROTAS ADMINISTRATIVAS (Categorias / Produtos)
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware'=>'auth.admin', 'where' => ['id'=>'[0-9]+']], function(){

    /*
    |--------------------------------------------------------------------------
    | Categorias
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'categories'], function(){

        Route::get('', ['as' => 'categories', 'uses' => 'Admin\CategoriesController@index']);

        Route::post('', ['as' => 'store_category', 'uses' => 'Admin\CategoriesController@store']);

        Route::get('create', ['as' => 'new_category', 'uses' => 'Admin\CategoriesController@create']);

        Route::get('{id}/show', ['as' => 'show_category', 'uses' => 'Admin\CategoriesController@show']);

        Route::get('destroy/{id}', ['as' => 'destroy_category', 'uses' => 'Admin\CategoriesController@destroy']);

        Route::get('{id}/edit', ['as' => 'edit_category', 'uses' => 'Admin\CategoriesController@edit']);

        Route::put('{id}/update', ['as' => 'update_category', 'uses' => 'Admin\CategoriesController@update']);

    });

    /*
    |--------------------------------------------------------------------------
    | Produtos
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'products'], function(){

        Route::get('', ['as' => 'products', 'uses' => 'Admin\ProductsController@index']);

        Route::post('', ['as' => 'store_product', 'uses' => 'Admin\ProductsController@store']);

        Route::get('create', ['as' => 'new_product', 'uses' => 'Admin\ProductsController@create']);

        Route::get('{id}/show', ['as' => 'show_product', 'uses' => 'Admin\ProductsController@show']);

        Route::get('destroy/{id}', ['as' => 'destroy_product', 'uses' => 'Admin\ProductsController@destroy']);

        Route::get('{id}/edit', ['as' => 'edit_product', 'uses' => 'Admin\ProductsController@edit']);

        Route::put('{id}/update', ['as' => 'update_product', 'uses' => 'Admin\ProductsController@update']);


        Route::group(['prefix' => 'images'], function(){

            Route::get('index/{id}', ['as' => 'products_images', 'uses' => 'Admin\ImageProductController@index']);

            Route::get('create/{id}', ['as' => 'products_images_create', 'uses' => 'Admin\ImageProductController@create']);

            Route::get('destroy/{id}', ['as' => 'products_images_destroy', 'uses' => 'Admin\ImageProductController@destroy']);

            Route::post('store/{id}', ['as' => 'products_images_store', 'uses' => 'Admin\ImageProductController@store']);

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Usuários
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'users'], function(){

        Route::get('', ['as' => 'users', 'uses' => 'Admin\UsersController@index']);

        Route::post('', ['as' => 'store_user', 'uses' => 'Admin\UsersController@store']);

        Route::get('create', ['as' => 'new_user', 'uses' => 'Admin\UsersController@create']);

        Route::get('{id}/show', ['as' => 'show_user', 'uses' => 'Admin\UsersController@show']);

        Route::get('destroy/{id}', ['as' => 'destroy_user', 'uses' => 'Admin\UsersController@destroy']);

        Route::get('{id}/edit', ['as' => 'edit_user', 'uses' => 'Admin\UsersController@edit']);

        Route::put('{id}/update', ['as' => 'update_user', 'uses' => 'Admin\UsersController@update']);

    });

    /*
    |--------------------------------------------------------------------------
    | Pedidos
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => 'orders'], function(){

        Route::get('', ['as' => 'orders', 'uses' => 'Admin\OrdersController@index']);

        Route::put('update/{id}', ['as' => 'order_update', 'uses' => 'Admin\OrdersController@update']);

    });

});
