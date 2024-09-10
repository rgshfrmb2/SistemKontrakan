<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Tambahkan ini
use App\Models\Booking;


class TempatController extends Controller
{
    public function index()
    {
        $tempats = Tempat::all();
        return view('tempats.index', compact('tempats'));
    }

    public function countBooking($id)
    {
        $tempat = Tempat::findOrFail($id);
        $bookingCount = Booking::where('tempat_id', $tempat->id)->count();
        return $bookingCount;
    }

    public function create()
    {
        return view('tempats.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tempat = new Tempat();
        $tempat->nama_tempat = $request->nama_tempat;
        $tempat->save();

        return redirect()->route('tempats.index')->with('success', 'Tempat berhasil disimpan');
    }
    
    public function edit($id)
    {
        $tempat = Tempat::find($id);
        return view('tempats.edit', compact('tempat'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tempat' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tempat = Tempat::find($id);
        $tempat->nama_tempat = $request->nama_tempat;
        $tempat->save();
        return redirect()->route('tempats.index')->with('success', 'Tempat berhasil diubah');
    }   

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $tempat = Tempat::find($id);
            $tempat->delete();
            return redirect()->route('tempats.index')->with('success', 'Tempat berhasil dihapus');
        } else {
            return redirect()->route('tempats.index')->with('error', 'Password tidak valid');
        }
    }

    public function validatePassword(Request $request, $id)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $tempat = Tempat::find($id);
            $tempat->delete();
            return response()->json(['message' => 'Tempat berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Password tidak valid'], 400);
        }
    }

public function countBookings($id)
{
    $tempat = Tempat::find($id);
    if ($tempat) {
        $bookingCount = Booking::where('tempat_id', $id)->count();
        return response()->json(['booking_count' => $bookingCount], 200);
    } else {
        return response()->json(['message' => 'Tempat tidak ditemukan'], 404);
    }
}
}
