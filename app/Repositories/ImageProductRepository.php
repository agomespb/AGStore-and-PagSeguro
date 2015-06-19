<?php

namespace AGStore\Repositories;

use AGStore\Models\Product;
use AGStore\Models\ProductImage;
use AGStore\Repositories\Contracts\ImageProductRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageProductRepository extends AbstractRepository implements ImageProductRepositoryInterface
{

    /**
     * @param Product $model
     */
    public function __construct(ProductImage $model)
    {
        /** @var Product $model */
        $this->model = $model;
    }

    public function modelImage()
    {
        return $this->model();
    }

    public function allImage()
    {
        return $this->getAll();
    }

    public function findImage($id)
    {
        return $this->find($id);
    }

    public function insertImage($id, array $data)
    {
        $file = $data['image'];
        $extension = $file->getClientOriginalExtension();
        $image = $this->create(['product_id' => $id, 'extension' => $extension]);

        Storage::disk('public_local')->put($image->id . '.' . $extension, File::get($file));

        return $image;
    }

    public function deleteImage($id)
    {
        $image = $this->find($id);
        $pathFile = public_path() . '/uploads/' . $image->imageFileName;

        if (file_exists($pathFile)) {
            Storage::disk('public_local')->delete($image->imageFileName);
        }

        $product = $image->product->id;
        $this->delete($id);

        return $product;
    }
}