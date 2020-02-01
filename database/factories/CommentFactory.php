<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_name' => $faker->word,
        'publish' => $faker->boolean(),
        'comment' => $faker->word,
        'post_id' => App\Post::first()->id,
        
    ];
});
