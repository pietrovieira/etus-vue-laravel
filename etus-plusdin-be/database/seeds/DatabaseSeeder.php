<?php

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
// use App\User;
// use App\Category;
use App\Brand;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
        factory(App\Category::class, 10)->create();
        Brand::create(
            [
                'name' => 'Mastercard',
            ]
        );
        Brand::create(
            [
                'name' => 'Visa',
            ]
        );
        Brand::create(
            [
                'name' => 'American Express',
            ]
        );
        Brand::create(
            [
                'name' => 'Elo',
            ]
        );

        factory(App\Card::class, 100)->create();

    }
}
