<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
  public function index()
  {
      return Product::paginate();
  }

  // public function create() {}

  public function store(Request $request)
  {
      $this->validate($request, [
        'name' => 'required|unique:products|productQuality'
      ]);
      return Product::create([
        'name' => $request->input('name')
      ]);
  }

  // public function show($id) {}

  // public function edit($id) {}

  public function update(Request $request, $id)
  {
    $product = Product::findOrFail($id);

    $product->update([
      'name' => $request->input('name')
    ]);
  }

  // public function destroy($id){}
}
