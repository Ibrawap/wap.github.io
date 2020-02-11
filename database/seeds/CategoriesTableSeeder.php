<?php

use App\PostCategory;
use App\SongCategory;
use App\VideoCategory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SongCategory::insert([
        	['title' => 'blues', 'slug' => 'blues'],
        	['title' => 'gospel music', 'slug' => 'gospel'],
        	['title' => 'upcoming music', 'slug' => 'upcoming-music'],
        	['title' => 'nigerian/african', 'slug' => 'nigerian-african'],
        	['title' => 'foreign music', 'slug' => 'foreign']
        ]);

        VideoCategory::insert([
        	['title' => 'music videos', 'slug' => 'music-videos'],
        	['title' => 'movies', 'slug' => 'movies'],
        	['title' => 'comedy videos', 'slug' => 'comedy-videos'],
        	['title' => 'foreign music videos', 'slug' => 'foreign-music-videos'],
        	['title' => 'sports', 'slug' => 'sports']
        ]);

        PostCategory::insert([
        	['title' => 'news', 'slug'=> 'news'],
        	['title' => 'romance', 'slug' => 'romance'],
        	['title' => 'health', 'slug' => 'health'],
        	['title' => 'sports', 'slug' => 'sports'],
        	['title' => 'entertainment', 'slug' => 'entertainment']
        ]);
    }
}
