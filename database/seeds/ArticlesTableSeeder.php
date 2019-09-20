<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
            ['name' => 'Granola 3kg', 'description' => 'Granola de la buena.', 'cost' => 30.75, 'cost_last_update' => now(), 'margin' => 30, 'margin_last_update' => now(), 'weight' => 3],
            ['name' => 'Granola 5kg', 'description' => 'Granola de la buena.', 'cost' => 45, 'cost_last_update' => now(), 'margin' => 40, 'margin_last_update' => now(), 'weight' => 5],
            ['name' => 'Arvejas 1kg', 'description' => 'Arvejas de las buenas.', 'cost' => 10.75, 'cost_last_update' => now(), 'margin' => 50, 'margin_last_update' => now(), 'weight' => 1],
            ['name' => 'Maiz inflado 0.5kg', 'description' => 'Maiz inflado del bueno.', 'cost' => 5, 'cost_last_update' => now(), 'margin' => 60, 'margin_last_update' => now(), 'weight' => 0.5],
            ['name' => 'Maiz inflado 1kg', 'description' => 'Maiz inflado del bueno.', 'cost' => 8.5, 'cost_last_update' => now(), 'margin' => 70, 'margin_last_update' => now(), 'weight' => 1],
        ];

        foreach ($articles as $article) {
            \DB::table('articles')->insert($article);
        }
    }
}
