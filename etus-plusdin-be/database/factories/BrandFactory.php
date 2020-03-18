<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => 'Visa',
    ];
});
$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => 'Mastercard',
    ];
});
$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => 'American Express',
    ];
});
$factory->define(Brand::class, function (Faker $faker) {
    return [
        'name' => 'Elo',
    ];
});
