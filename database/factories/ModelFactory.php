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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\NewsCategory::class, function (Faker\Generator $faker) {
    return [
        'category' => $faker->word,
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph(random_int(25, 150)),
        'news_category_id' => App\NewsCategory::all()->random()->id,
        'liked' => $faker->numberBetween(0, 1024),
        'shared' => $faker->numberBetween(0, 1024),
    ];
});

$factory->define(App\Scholarship::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'organizer' => $faker->company,
        'place' => $faker->country,
        'description' => $faker->paragraph(random_int(25, 75)),
        'deadline' => $faker->dateTime('2020-01-01'),
        'liked' => $faker->numberBetween(0, 1024),
        'shered' => $faker->numberBetween(0, 1024),
    ];
});
