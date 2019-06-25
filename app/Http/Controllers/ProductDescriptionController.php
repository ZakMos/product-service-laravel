<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Description;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductDescriptionController extends Controller
{
    public function index($productId)
    {
        return Description::ofProduct($productId)->paginate();
    }
    // public function create(){}
    public function store($productId, Request $request)
    {
      $product = Product::findOfFail($productId);

      $product->descriptions()->save(new Description([
        'body' => $request->input('body')
      ]));

      return $product->descriptions;
    }
    // public function show($id) {}
    // public function edit($id) {}
    // public function update(Request $request, $id){}
    // public function destroy($id) {}
}
