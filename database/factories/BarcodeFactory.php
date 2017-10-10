<?php

use Faker\Generator as Faker;

$factory->define(App\Barcode::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            factory('App\User')->create()->id;
        },
        'code' => $faker->numerify('#########'),
        'type' => $faker->randomElement(['ISBN']),
        'format' => $faker->randomElement(['EAN_13']),
        'imageUrl' => $faker->url,
    ];
});