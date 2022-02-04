<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Post::factory(100)->create()->each(function ($post) {
            $post->tags()->save(Tag::factory()->make());
            User::all()->random(10)->each(function ($user) use($post){
                Like::create([
                        'post_id' => $post->id,
                        'user_id' => $user->id
                    ]);
            });
        });
    }
}
