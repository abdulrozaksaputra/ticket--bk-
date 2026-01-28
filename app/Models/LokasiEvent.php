<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiEvent extends Model
{
    use HasFactory;

    protected $table = 'lokasi_events';

    protected $fillable = [
        'nama',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'lokasi_id');
    }
}
