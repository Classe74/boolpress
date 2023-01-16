<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Functions\Helpers;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // $postsarray = Helpers::getCsvContents(__DIR__.'/data.csv');
    // public function run()
    // {
    //     $movies = Movie::all();
    //     $categories = Category::pluck("id");
    //     foreach ($movies as $movie) {
    //         $randomCategoryNumber = rand(1, count($categories));
    //         $shuffleCategories=$categories->shuffle();
    //         $movieCategories= $shuffleCategories->slice(0, $randomCategoryNumber);
    //         $movie->categories()->attach($movieCategories);
    //     }
    // }
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->slug = Str::slug($post->title, '-');
            $post->content = $faker->text(500);
            $post->save();
        }
    }
}
