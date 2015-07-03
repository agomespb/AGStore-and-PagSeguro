<?php

namespace AGStore\Http\Controllers\Store;

use AGStore\Http\Controllers\Controller;
use AGStore\Http\Requests;
use AGStore\Repositories\Contracts\CategoryRepositoryInterface;
use AGStore\Repositories\Contracts\PagSeguroNotificationRepositoryInterface;
use AGStore\Repositories\Contracts\PagSeguroTransactionRepositoryInterface;
use AGStore\Repositories\Contracts\ProductRepositoryInterface;
use AGStore\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $categories;
    private $products;

    /**
     * @return void
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->products = $productRepositoryInterface;
        $this->categories = $categoryRepositoryInterface;
    }

    /**
     * Show the application.
     *
     * @return Response
     */
    public function index()
    {
        $produtosEmDestaque = $this->products->getFeatured(null);
        $produtosRecomendados = $this->products->getRecommend(null);
        $categorias = $this->categories->listCategories();

        return view('store.index', compact('categorias', 'produtosEmDestaque', 'produtosRecomendados'));
    }

    /**
     * Show the application For Category.
     *
     * @return Response
     */
    public function indexCategory($id)
    {
        $produtosEmDestaque = $this->products->getFeatured($id);
        $produtosRecomendados = $this->products->getRecommend($id);
        $categorias = $this->categories->listCategories();

        return view('store.index', compact('categorias', ['category_id' => $id], 'produtosEmDestaque', 'produtosRecomendados'));
    }

    /**
     * Show the application For Category.
     *
     * @return Response
     */
    public function productShow($id)
    {
        $produto = $this->products->findProduct($id);
        $categorias = $this->categories->listCategories();
        return view('store.product_show', compact('categorias', 'produto'));
    }

    /**
     *
     * @return Response
     */
    public function getPagSeguroTransaction(Request $request, PagSeguroTransactionRepositoryInterface $transaction)
    {
        $parameters = $request->all();

        if ($parameters && array_key_exists('transaction', $parameters)) {

            $code = str_replace('-', "", $parameters['transaction']);;
            $find = $transaction->findByTransaction($code)->first();

            if (is_null($find) && count($find) < 1) {
                $dataTransaction = ['code' => $code];
                $transaction->insertTransaction($dataTransaction);
            }
        }

        return redirect()->route('index');
    }

    /**
     *
     * @return Response
     */
    public function postPagSeguroTransaction(
        Request $request,
        PagSeguroNotificationRepositoryInterface $notification,
        PagSeguroTransactionRepositoryInterface $transaction
    )
    {
        $parameters = $request->all();

        if ($parameters && array_key_exists('notificationCode', $parameters)) {

            $link = $transaction->pagSeguroNotificationLink($parameters['notificationCode']);
            $transactionSaved = $transaction->saveTransaction($link);

            $parameters['transaction_id'] = $transactionSaved->id;
            $notification->insertNotification($parameters);
        }

        return redirect()->route('index');
    }

    public function tagProducts($id, TagRepositoryInterface $tags)
    {
        $tag = $tags->findTag($id);
        $produtos = $tag->products;
        $categorias = $this->categories->listCategories();

        return view('store.products_of_tag', compact('categorias', 'produtos', 'tag'));
    }

}
