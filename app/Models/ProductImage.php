<?php

namespace AGStore\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'extension'];

    public function product()
    {
        return $this->belongsTo('AGStore\Models\Product');
    }

    public function getImageFileNameAttribute()
    {
        return $this->id . '.' . $this->extension;
    }
}
