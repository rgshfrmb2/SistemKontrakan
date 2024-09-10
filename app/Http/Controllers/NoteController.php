<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Booking;
use App\Models\Tempat;

class NoteController extends Controller
{
 
    public function index(Request $request)
    {
        $booking_id = $request->input('booking_id');
        $notes = Note::where('booking_id', $booking_id)->get();
        return view('note.index', compact('notes'));
    }

    

    public function create()
    {
        $bookings = Booking::all();
        return view('note.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $note = Note::create($request->all());
        return redirect()->route('notes.index', ['booking_id' => $request->booking_id])->with(compact('note'));
    }

    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        $note->update($request->all());
        return redirect()->route('note.index',  ['booking_id' => $request->booking_id],compact('note'));
    }
}
