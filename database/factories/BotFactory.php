<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bot;
use App\User;
use Faker\Generator as Faker;

$factory->define(Bot::class, function (Faker $faker) {

    $category_id = User::all('id')->random(1)->toArray();
    return [
        'user_id' => $category_id[0]['id'],
        'name' => $faker->word,
        'description' => $faker->realText(25),
    ];
});
