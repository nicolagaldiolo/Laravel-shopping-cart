<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->unique()->isbn13,
        'author' => $faker->name,
        'title' => $faker->catchPhrase,
        'category_id' => function(){
            return factory(App\Category::class)->create();
        },
        'price' => $faker->randomFloat(2, 1, 99),
        'description' => $faker->text
    ];
});
