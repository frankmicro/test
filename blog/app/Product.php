<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//test
    protected $table = "product";

    protected $fillable = ['name'];

    public function productDetails()
    {
    	return $this->hasMany('App\ProductDetails','product_id');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
    	return $query->whereHas($relation, $constraint)
                 ->with([$relation => $constraint]);
	}
}
