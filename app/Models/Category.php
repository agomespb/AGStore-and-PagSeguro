<?php

namespace AGStore\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('AGStore\Models\Product');
    }

    /**
     * @return mixed
     */
    public function getListAllAttribute()
    {
        return $this->lists('name', 'id');
    }

}
