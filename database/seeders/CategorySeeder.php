<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_list = [
            'Clothing & Fashion Accessories',
            'Healthcare & Hygiene',
            'Shoes & Bags',
            'Books & Stationary',
            'Computer & Accessories',
            'Consumer Electronics',
            'Security Systems & Accessories',
            'Mobile & Accessories'
        ];

        for($i =0; $i<count($category_list); $i++) {
            Category::create([
                'category_name' => $category_list[$i],
                'category_slug' => Str::slug($category_list[$i]),
            ]);
        }
    }
}
