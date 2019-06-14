<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descriptions extends Model
{
    public function descreptions ()
    {
      return $this->hasMany(Description::class);
    }
}
