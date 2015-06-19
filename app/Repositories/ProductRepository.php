<?php

namespace AGStore\Repositories;


use AGStore\Models\Product;
use AGStore\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        /** @var Product $model */
        $this->model = $model;
    }

    public function modelProduct()
    {
        return $this->model();
    }

    public function allProduct()
    {
        return $this->getAll();
    }

    public function findProduct($id)
    {
        return $this->find($id);
    }

    public function paginateProduct($number = 10)
    {
        return $this->model()->paginate($number);
    }

    public function insertProduct(array $data)
    {
        $tags = array_map('trim', explode(',', $data['tags']));

        unset($data['tags']);

        $product = $this->create($data);

        if ( count($tags) ) {
            $syncTag = $product->tags()->ofCheckTags($tags);
            $product->tags()->sync($syncTag);
        }

        return $product;
    }

    public function updateProduct($id, array $data)
    {

        $product = $data;
        $tag = array_map('trim', explode(',', $product['tags']));

        unset($product['tags']);

        $tags = $this->model()->tags()->ofCheckTags($tag);

        $update = $this->update($id, $product);
        $update->tags()->sync($tags);

        return $update;
    }

    public function deleteProduct($id)
    {
        $product = $this->find($id);

        if( !$product ){
            return false;
        }

        if( count($product->images) ):
            foreach ($product->images as $image) {
                $imagePathFile = public_path() . '/uploads/' . $image->imageFileName;
                if (file_exists($imagePathFile)) {
                    Storage::disk('public_local')->delete($image->imageFileName);
                }
            }
        endif;

        $del = $product->delete();

        if( $del ):
            Session::flash('flash_message', 'Produto excluído com sucesso!');
            return $del;
        endif;

        return false;
    }

    public function getFeatured($id = null)
    {
        return $this->modelProduct()->ofFeatured($id)->get();
    }

    public function getRecommend($id = null)
    {
        return $this->modelProduct()->ofRecommend($id)->get();
    }
}