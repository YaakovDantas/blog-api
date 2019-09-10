<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "comment" => $faker->realText($maxNbChars = 30, $indexSize = 1),
        "user_id" => $faker->numberBetween($min=1, $max=6),
        "post_id" => $faker->randomDigitNotNull
    ];
});
