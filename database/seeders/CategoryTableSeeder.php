<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name'     => 'Cake & Bakery',
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
        ]);
        Category::create([
            'name'     => 'Fashion',
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
        ]);
        Category::create([
            'name'     => 'Gerabah',
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
        ]);
        Category::create([
            'name'     => 'Elektronik',
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
        ]);
        Category::create([
            'name'     => 'Food',
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
        ]);
    }
}
