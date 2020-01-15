<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Posts;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->sentence(20),
        'description' => $faker->sentence(10),
        'image' => $faker->image('public/storage/uploads/posts', 640, 480, null, false),
    ];
});
