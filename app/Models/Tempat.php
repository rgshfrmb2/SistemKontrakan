<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class Tempat extends Model
{
    use HasFactory;
    protected $table = 'tempats';
    protected $fillable = [
        'nama_tempat',
    ];

    public function countBooking($id)
    {
        $tempat = DB::table('tempats')->find($id);
        $bookingCount = Booking::where('tempat_id', $tempat->id)->count();
        return $bookingCount;
    }
}
