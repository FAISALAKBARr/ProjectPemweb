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
            ['name' => 'Burger', 'price' => 5.99],
            ['name' => 'Pizza', 'price' => 8.99],
            ['name' => 'Sushi', 'price' => 12.99],
            ['name' => 'Pasta', 'price' => 7.99],
        ]);
    }
}

