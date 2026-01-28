<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\PaymentType;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $event->load(['tikets', 'kategori', 'user', 'lokasiEvent']);

        $paymentTypes = PaymentType::all(); // ambil semua tipe pembayaran


        return view('events.show', compact('event', 'paymentTypes'));
    }
}
