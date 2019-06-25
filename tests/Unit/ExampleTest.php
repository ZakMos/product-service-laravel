<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function testBasicTest()
     {
        $this->assertTrue(true);
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

    public function testProductCreation()
    {
      $product = factory(\App\Product::class)->make(['name' => 'beets']);

      $this->post(route('api.products.store'), $product->jsonSerilaize(), $this->jsonHeaders)
          ->seeInDatabase('products', ['name' => $product->name])
          ->assertResponseOk();
    }

    public function testProductDescriptionCreation()
    {
      $product = factory(\App\Product::class)->make(['name' => 'beets']);
      $description = factory(\App\Description::class)->make();
      $this->post(route('api.products.descriptions.store', ['products' => $product->id]), $description->jsonSerilaize(), $this->jsonHeaders)
          ->seeInDatabase('descriptions', ['body' => $description->body])
          ->assertResponseOk();
    }

    public function testProductUpdate()
    {
      $product = factory(\App\Product::class)->make(['name' => 'beets']);
      $product->name = 'feets';

      $this->post(route('api.products.update', ['products' => $product->id]), $product->jsonSerilaize(), $this->jsonHeaders)
          ->seeInDatabase('products', ['name' => $product->name])
          ->assertResponseOk();
    }

    public function testProductFailsWhenNameNotProvided()
    {
      $product = factory(\App\Product::class)->make(['name' => '']);

      $this->post(route('api.products.store'), $product->jsonSerilaize(), $this->jsonHeaders)
          ->seeJson(['name' => ['The name field is required']])
          ->assertResponseStatus(422);
    }

    public function testProductFailsWhenNameNotUnique()
    {
      $product1 = factory(\App\Product::class)->create(['name' => 'name']);
      $product2 = factory(\App\Product::class)->make(['name' => $name]);
      $this->post(route('api.products.store'), $product2->jsonSerilaize(), $this->jsonHeaders)
          ->seeJson(['name' => ['The name field is already taken.']])
          ->assertResponseStatus(422);
    }

    public function testProductDescriptionCreationFailsWhenBodyNotProvided()
    {
      $product = factory(\App\Product::class)->make(['name' => 'beets']);
      $description = factory(\App\Description::class)->make(['body' => '']);
      $this->post(route('api.products.descriptions.store', ['products' => $product->id]), $description->jsonSerilaize(), $this->jsonHeaders)
        ->seeJson(['body' => ['The body field is required.']])
        ->assertResponseStatus(422);
    }
}
