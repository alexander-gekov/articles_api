<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'summary' => $faker->sentence,
        'body' => $faker->text,
        'author' => $faker->name,
        'email' => $faker->email,
    ];
});
