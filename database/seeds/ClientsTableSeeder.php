<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            ['name' => 'German Amigo', 'email' => 'keepemailsforme@gmail.com'],
            ['name' => 'Marcos Cliente Regular', 'email' => 'keepemailsforme@gmail.com'],
            ['name' => 'Julio Cliente general', 'email' => 'keepemailsforme@gmail.com'],
        ];

        foreach ($clients as $client) {
            \DB::table('clients')->insert($client);
        }
    }
}
