<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => 'Taylor', 'surname' => 'Otwell'],
            ['name' => 'Taylor', 'surname' => 'Taylor'],
            ['name' => 'Jeffrey', 'surname' => 'Way'],
            ['name' => 'Phill', 'surname' => 'Sparks'],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate($client);
        }
    }
}