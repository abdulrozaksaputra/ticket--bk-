<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            LokasiEventSeeder::class,
            EventSeeder::class,
            TicketTypeSeeder::class,
            TicketSeeder::class,
            PaymentTypeSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
