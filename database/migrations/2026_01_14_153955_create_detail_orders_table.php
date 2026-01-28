<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('tiket_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            // Max Value: 99.999.999,99 (Indonesia Rupiah)
            // $table->decimal('subtotal_harga', 10, 2);
            $table->decimal('subtotal_harga', 15, 2); // Max ~999 triliun
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
