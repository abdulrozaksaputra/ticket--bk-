<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_types = [
            ['nama' => 'Credit Card'],
            ['nama' => 'Bank Transfer'],
            ['nama' => 'E-Wallet'],
        ];

        foreach ($payment_types as $type) {
            PaymentType::create($type);
        }
    }
}
