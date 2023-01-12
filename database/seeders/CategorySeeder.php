<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Javscript', 'PHP', 'Laravel', 'Vue'];
        foreach($categories as $category){
            $newcategory = new Category();
            $newcategory->name = $category;
            $newcategory->slug = Str::slug($newcategory->name, '-');
            $newcategory->save();
        }
    }
}
