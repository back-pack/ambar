<?php

use Illuminate\Database\Seeder;

class MarginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $margins = [
            ['name' => 'Precio amigo', 'profit' => 10],
            ['name' => 'Precio cliente regular', 'profit' => 50],
            ['name' => 'Precio general', 'profit' => 70],
        ];

        foreach ($margins as $margin) {
            \DB::table('margins')->insert($margin);
        }
    }
}
