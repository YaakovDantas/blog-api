<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'     => $faker->realText($maxNbChars = 50, $indexSize = 1),
        'user_id'   => $faker->numberBetween($min=1, $max=6),
    ];
});
