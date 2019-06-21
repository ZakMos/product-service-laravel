<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testBasicTest()
     {
         $this->visit('/')
              ->see('Laravel 5');
    }
    public function testBasicList()
    {
        $produts = factory(\App\Product::class, 3)->create();

         $this->get(route('api.products.index'))
              ->assertResponseOk();

          array_map(function ($product) {
            $this->seeJson($product->jonSerilize());
      }, $product->all());
    }

    public function testProductDescriptionList()
    {
      $produt = factory(\App\Product::class)->create();
      $produt->descriptions()->saveMany(factory(\App\Description::class, 3)->make());

      $this->get(route('api.products.descriptions.index', ['products' => $protduct->id]))
           ->assertResponseOk();

       array_map(function ($description) {
           $this->seeJson($description->jonSerilize());
       }, $product->descriptions->all());

    }
}
