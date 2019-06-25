<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $fillable = ['name'];

  public function descreptions ()
  {
    return $this->hasMany(Description::class);
  }
  //
  // public function scopOfProduct($query, $productId)
  // {
  //   return $query->where('product_id', $productId);
  // }


    // public function product()
    // {
    //   $this->belongsTo(Product::class);
    // }
}
