@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            <h4>Buat Catatan Baru</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('notes.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" class="form-control" id="catatan" required></textarea>
            </div>
            <div class="form-group">
                <label for="tempat_id">Tempat</label>
                <select name="booking_id" class="form-control" id="booking_id" required>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}">{{ $booking->nama_pemesan }}</option>
                    @endforeach
                </select>
            </div>
              <button type="submit" class="btn btn-primary mt-3">Buat</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection