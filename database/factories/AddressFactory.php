<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [

        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'country' => $faker->country,
        'default' => false,
        'billing' => false,
        'user_id' => function() {
            return factory(App\User::class)->create();
        }
    ];
});
