<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->unique()->word,
        'publish' => $faker->boolean(),
        
    ];
});
