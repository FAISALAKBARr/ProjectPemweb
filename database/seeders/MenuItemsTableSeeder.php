<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            ['name' => 'Burger', 'price' => 5.99, 'image' => 'burger.jpg'],
            ['name' => 'Pizza', 'price' => 8.99, 'image' => 'pizza.jpg'],
            ['name' => 'Sushi', 'price' => 12.99, 'image' => 'sushi.jpg'],
            ['name' => 'Pasta', 'price' => 7.99, 'image' => 'pasta.jpg'],
            ['name' => 'Kuaci', 'price' => 0.3, 'image' => 'kuaci.jpg'],
            ['name' => 'Air Mineral', 'price' => 1.00, 'image' => 'air_mineral.jpg'],
            ['name' => 'Coca cola', 'price' => 1.05, 'image' => 'coca_cola.jpg'],
            ['name' => 'Sari Roti', 'price' => 0.56, 'image' => 'sari_roti.jpg'],
        ]);
    }
}

