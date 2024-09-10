<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class MasterController extends Controller
{
public function notifikasi()
{
    $today = date('Y-m-d');
    $bookings = Booking::where('tanggal_jatuh_tempo', $today)
                        ->whereNull('tanggal_pembayaran')
                        ->get();
    return view('notifikasi', compact('bookings'));
}

public function getUserId()
{
    $user = User::find(Auth::user()->id);
    return response()->json([
        'name' => $user->name,
        'email' => $user->email
    ]);

    return view('layouts.master', compact('user'));
}

}
