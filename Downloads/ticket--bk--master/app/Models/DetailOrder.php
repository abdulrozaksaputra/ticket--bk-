<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tiket_id',
        'jumlah',
        'subtotal_harga',
        'payment_type_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
