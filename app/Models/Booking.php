<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'nama_pemesan',
        'biaya',
        'start_date',
        'end_date',
        'tanggal_pembayaran',
        'tanggal_jatuh_tempo',
        'tempat_id',
        'ruangan',
        'status'
    ];

    public function getTempat()
    {
        return $this->belongsTo('App\Models\Tempat', 'tempat_id');
    }
}
