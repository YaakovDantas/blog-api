<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        #Forma automatica e randomica
        factory(Post::class, 10)->create();

        
    }
    
}
