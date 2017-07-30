<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        'slug' => 'admin',
        'name' => 'Admin',
      ]);
      DB::table('roles')->insert([
        'slug' => 'user',
        'name' => 'User',
      ]);

      DB::table('users')->insert([
        'full_name' => 'Halim Lebah',
        'username' => 'halimlebah',
        'email' => 'halimlebah@gmail.com',
        'password' => bcrypt('ngktau'),
      ]);

      DB::table('role_users')->insert([
        'user_id' => App\User::all()->first()->id,
        'role_id' => '1',
      ]);

      DB::table('activations')->insert([
        'user_id' => App\User::all()->first()->id,
        'code' => str_random(32),
        'completed' => '1',
        'completed_at' => date('Y-m-d H:i:s'),
      ]);

      factory(App\User::class, 150)->create()->each(function ($user) {
        DB::table('role_users')->insert([
          'user_id' => $user->id,
          'role_id' => '2',
        ]);

        DB::table('activations')->insert([
          'user_id' => $user->id,
          'code' => str_random(32),
          'completed' => '1',
          'completed_at' => date('Y-m-d H:i:s'),
        ]);
      });

      DB::table('news_category')->insert([
        'category' => 'Politic',
      ]);
      DB::table('news_category')->insert([
        'category' => 'Entertaiment',
      ]);
      DB::table('news_category')->insert([
        'category' => 'Health',
      ]);
      DB::table('news_category')->insert([
        'category' => 'Sport',
      ]);
      DB::table('news_category')->insert([
        'category' => 'News Paper',
      ]);

      factory(App\News::class, 100)->create()->each(function ($news) {
        $userIds = range(1, 151);
        shuffle($userIds);
        $likeduser = array_slice($userIds, 0, random_int(2, 151));
        $news->likes()->attach($likeduser);
      });
      factory(App\NewsComment::class, 500)->create();

      factory(App\Scholarship::class, 100)->create();
      factory(App\ScholarshipsComment::class, 500)->create();
    }
}
