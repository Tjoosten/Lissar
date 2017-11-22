<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'author_id'   => function () {
            return factory(App\User::class)->create()->id;
        },
        'name'        => $faker->name,
        'type'        => $faker->name,
        'price'       => $faker->randomDigit,
        'description' => $faker->realText(rand(10,20)),
    ];
});
