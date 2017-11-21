<?php

use Faker\Generator as Faker;

$factory->define(App\Priority::class, function (Faker $faker) {
    return [
        'author_id'  => function ($faker) {
            return factory(App\User::class)->create()->id;
        },
        'color_code'  => $faker->hexColor, 
        'name'        => $faker->name, 
        'description' => $faker->realText(50, 2), 
    ];
});
