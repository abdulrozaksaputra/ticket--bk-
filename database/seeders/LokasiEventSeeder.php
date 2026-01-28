<?php

namespace Database\Seeders;

use App\Models\LokasiEvent;
use Illuminate\Database\Seeder;

class LokasiEventSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['nama' => 'Stadion Utama'],
            ['nama' => 'Galeri Seni Kota'],
            ['nama' => 'Taman Kota'],
        ];

        foreach ($locations as $location) {
            LokasiEvent::create($location);
        }
    }
}
