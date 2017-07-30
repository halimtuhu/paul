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
        'full_name' => $faker->name,
        'username' => $faker->unique()->name . random_int(0, 99),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
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
        'content' => function () {
          $faker = Faker\Factory::create();
          $content = "";
          for ($i=0; $i < random_int(3, 7); $i++) {
            $content = $content."<p>".$faker->paragraph(random_int(5,10))."</p>";
          };
          return $content;
        },
        'news_category_id' => App\NewsCategory::all()->random()->id,
        'liked' => $faker->numberBetween(0, 1024),
        'shared' => $faker->numberBetween(0, 1024),
        'featured_image' => random_int(1, 10) . '.jpg',
    ];
});

$factory->define(App\NewsComment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'news_id' => App\News::all()->random()->id,
        'comment' => $faker->sentence,
    ];
});

$factory->define(App\Scholarship::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'organizer' => $faker->company,
        'place' => $faker->country,
        'description' => function () {
          $faker = Faker\Factory::create();
          $content = "";
          for ($i=0; $i < random_int(1, 3); $i++) {
            $content = $content."<p>".$faker->paragraph(random_int(5,10))."</p>";
          };
          return $content;
        },
        'deadline' => $faker->dateTime('2020-01-01'),
        'liked' => $faker->numberBetween(0, 1024),
        'shered' => $faker->numberBetween(0, 1024),
        'featured_image' => random_int(1, 25) . '.jpg',
    ];
});

$factory->define(App\NewsComment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'news_id' => App\News::all()->random()->id,
        'comment' => $faker->paragraph,
    ];
});

$factory->define(App\ScholarshipsComment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'scholarships_id' => App\Scholarship::all()->random()->id,
        'comment' => $faker->paragraph,
    ];
});
