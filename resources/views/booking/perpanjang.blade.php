@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="card">
                <div class="card-header">
                    <h4>Perpanjang Booking</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.perpanjang', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="end_date">Tanggal Akhir Baru</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required min="{{ $booking->end_date }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="biaya_tambahan">Biaya Tambahan</label>
                            <input type="number" name="biaya_tambahan" id="biaya_tambahan" class="form-control" required min="0">
                        </div>
                        <button type="submit" class="btn btn-primary">Perpanjang Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
