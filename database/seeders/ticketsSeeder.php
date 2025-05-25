<?php

namespace Database\Seeders;

use App\Models\ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ticketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 100; $i++) {
            ticket::create([
                'number' => $i,
                'status' => 'disponible',
            ]);
        }
    }
}
