<?php

$factory->define(App\Product::class, function ($faker) {
  return [
    'name' => $faker->string,
  ];
});

$factory->define(App\Description::class, function ($faker) {
  return [
    'body' => $faker->text,
  ];
});
