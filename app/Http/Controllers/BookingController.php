<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tempat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $tempat_id = $request->input('tempat_id');
        $bookings = Booking::where('tempat_id', $tempat_id)->get();
        return view('booking.index', compact('bookings'));
    }

    public function kwitansi(Request $request, $id)
    {
      
            $booking = Booking::find($id);
            
            return view('booking.Kwitansi', compact('booking'));
       
    }

    public function create()
    {
        $tempats = Tempat::all();
        return view('booking.create', compact('tempats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'biaya' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'tanggal_jatuh_tempo' => 'required',
            'tempat_id' => 'required',
            'ruangan' => 'required',
            'status' => 'required',
        ]);

        $create = Booking::create([
            'nama_pemesan' => $request->nama_pemesan,
            'biaya' => $request->biaya,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'tempat_id' => $request->tempat_id,
            'ruangan' => $request->ruangan,
            'status' => $request->status,
        ]);

        if ($create) {
            return redirect()->route('bookings.index', ['tempat_id' => $request->tempat_id])
                ->with('success', 'Berhasil Menyimpan !');
        }
        return redirect()->route('bookings.create')->with('error', 'Data gagal disimpan');
    }

    public function filterByPaymentDate($date)
    {
        $bookings = Booking::where('tanggal_pembayaran', $date)->get();
        return view('booking.index', compact('bookings'));
    }

    // public function show($id)
    // {
    //     $booking = Booking::find($id);
    //     return view('booking.show', compact('booking'));
    // }

    public function edit($id)
    {
        $booking = Booking::find($id);
        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());
        return redirect()->route('bookings.index', ['tempat_id' => $request->tempat_id])
        ->with('success', 'Berhasil Update !');    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $booking = Booking::find($id);
            $booking->delete();
            return redirect()->route('bookings.index', ['tempat_id' => $request->tempat_id])
            ->with('success', 'Berhasil Dihapus !');
        } else {
            return redirect()->route('bookings.index', ['tempat_id' => $request->tempat_id])
            ->with('error', 'Password tidak valid');
        }
    }

    // public function perpanjangBooking(Request $request, $id)
    // {
    //     $booking = Booking::find($id);
        
    //     if (!$booking) {
    //         return redirect()->route('bookings.index')->with('error', 'Booking tidak ditemukan');
    //     }
        
    //     $request->validate([
    //         'end_date' => 'required|date|after:' . $booking->end_date,
    //         'biaya_tambahan' => 'required|numeric|min:0',
    //     ]);
        
    //     $booking->end_date = $request->end_date;
    //     $booking->biaya += $request->biaya_tambahan;
        
    //     if ($booking->save()) {
    //         return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil diperpanjang');
    //     } else {
    //         return redirect()->route('bookings.show', $booking->id)->with('error', 'Gagal memperpanjang booking');
    //     }
    // }

    public function formPerpanjangBooking($id)
    {
        $booking = Booking::find($id);
        
        if (!$booking) {
            return redirect()->route('bookings.index')->with('error', 'Booking tidak ditemukan');
        }
        
        return view('booking.perpanjang', compact('booking'));
    }
}
