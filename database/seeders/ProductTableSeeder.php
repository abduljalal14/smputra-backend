<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Roti Bolu',
            'desc'  => 'Roti Bolu dengan varian rasa',
            'price' => 50000
        ]);
        Product::create([
            'category_id' => 1,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Roti Kacang',
            'desc'  => 'Roti Bolu dengan varian rasa',
            'price' => 40000
        ]);
        Product::create([
            'category_id' => 1,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Brownies',
            'desc'  => 'Roti Bolu dengan varian rasa',
            'price' => 30000
        ]);

        Product::create([
            'category_id' => 2,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Baju Koko',
            'desc'  => 'Baju Koko Anak-anak',
            'price' => 60000
        ]);
        Product::create([
            'category_id' => 2,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Kerudung Pasmina',
            'desc'  => 'Kerudung pasmina warna biru',
            'price' => 60000
        ]);
        Product::create([
            'category_id' => 2,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Sarung Tursina',
            'desc'  => 'Sarung hitam untuk bapak-bapak',
            'price' => 70000
        ]);

        Product::create([
            'category_id' => 3,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Panci',
            'desc'  => 'Sarung hitam untuk bapak-bapak',
            'price' => 70000
        ]);
        Product::create([
            'category_id' => 3,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Wajan Teflon',
            'desc'  => 'Sarung hitam untuk bapak-bapak',
            'price' => 70000
        ]);
        Product::create([
            'category_id' => 3,
            'image' => '0xCeuAUwZ85ZGmUQExoZX6HQEbJ3hXJXWuyCmvpk.jpg',
            'name'     => 'Kompor Listrik',
            'desc'  => 'Sarung hitam untuk bapak-bapak',
            'price' => 70000
        ]);

        // 'category_id',
        // 'image',
        // 'name',
        // 'desc',
        // 'price'
    }
}
