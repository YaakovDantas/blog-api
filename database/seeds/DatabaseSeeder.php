<?php

use Illuminate\Database\Seeder;
use App\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class
            ]);
        
    }
}


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        factory(User::class, 5)->create();
        User::create([
            'email' => "teste@gmail.com",
            "name" => "teste",
            "password" => Hash::make("senha")
        ]);
    }
}