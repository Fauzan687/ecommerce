<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // <- Tambahkan ini

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tokoonline.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Create categories
        $categories = ['Elektronik', 'Pakaian', 'Makanan', 'Buku'];
        foreach($categories as $category) {
            Category::create([
                'name' => $category, 
                'slug' => Str::slug($category) // <- Sekarang tidak error
            ]);
        }

        // Create sample products
        Product::create([
            'name' => 'Laptop ASUS',
            'description' => 'Laptop ASUS core i5, 8GB RAM, 512GB SSD',
            'price' => 8000000,
            'stock' => 10,
            'category_id' => 1,
            'image' => 'products/laptop.jpg'
        ]);

        Product::create([
            'name' => 'Kaos Polos',
            'description' => 'Kaos polos cotton combed 30s',
            'price' => 50000,
            'stock' => 50,
            'category_id' => 2,
            'image' => 'products/kaos.jpg'
        ]);
    }
}