<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId("event_id")->constrained()->onDelete('cascade');
            $table->dateTime("order_date");
            // Max Value: 99.999.999,99 (Indonesia Rupiah)
            // $table->decimal('total_harga', 10, places: 2);
            $table->decimal('total_harga', 15, 2); // Max ~999 triliun
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
