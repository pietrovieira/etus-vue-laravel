<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'imagem' => 'https://res.cloudinary.com/value-penguin/image/upload/c_limit,dpr_1.0,f_auto,h_1600,q_auto,w_1600/v1/unavailable-card-update_c5bzxf.png',
        'limit' => $faker->numberBetween(1,10000),
        'limit_tax' => $faker->numberBetween(1,10000),
        'user_id' => 1,
        'brand_id' => $faker->numberBetween(1,4),
        'category_id' => $faker->numberBetween(1,10),
    ];
});
