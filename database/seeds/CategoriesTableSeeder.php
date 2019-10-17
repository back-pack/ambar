<?php

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
        $categories = [
            ['name' => 'Frutos secos'],
            ['name' => 'Legumbres'],
            ['name' => 'Azucar y esencias'],
            ['name' => 'Harinas'],
            ['name' => 'Mix de frutas'],
            ['name' => 'Almohaditas rellenas'],
            ['name' => 'Condimentos'],
            ['name' => 'Semillas'],
            ['name' => 'Snacks'],
        ];

        foreach ($categories as $category) {
            \DB::table('categories')->insert($category);
        }
    }
}
