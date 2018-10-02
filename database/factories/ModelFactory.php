<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\Hash;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('secret'),
        'api_token' => str_random(32)
    ];
});

$factory->define(App\Recommendation::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 50),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body' => $faker->text($maxNbChars = 200),
        'poster' => str_random(20),
        'backdrop' => str_random(20)
    ];
});

$factory->define(App\RecommendationItem::class, function (Faker\Generator $faker) {
    return [
        'recommendation_id' => $faker->numberBetween($min = 1, $max = 50),
        'name' => $faker->name,
        'year' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'overview' => $faker->text($maxNbChars = 400),
        'poster' => str_random(20),
        'backdrop' => str_random(20),
        'trailer' => str_random(20),
        'commentary' => $faker->text($maxNbChars = 500)
    ];
});

$factory->define(App\Genre::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Keyword::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(App\Source::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});