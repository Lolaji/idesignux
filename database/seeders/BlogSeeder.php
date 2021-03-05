<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'title' => 'This is my first blog',
                'slug' => 'This-is-my-first-blog',
                'description' => 'This the description for my first blog',
                'content' => '<p>This the content of my first blog</p>',
                'updated_at' => now(),
                'created_at' => now(),
            ],
        ]);
    }
}
