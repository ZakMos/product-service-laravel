<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function product()
    {
      $this->belongsTo(Product::class);
    }
}
