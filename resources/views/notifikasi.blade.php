@extends('layouts.master')

@section('content')
<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-7">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-5">
                    <h4 class="text-center mb-4">YUK INGATKAN PEMBAYARAN!</h4>
                    <div class="list-group">
                        @foreach($bookings as $index => $booking)
                        <a href="{{ route('bookings.show', $booking->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $booking->nama_pemesan }}</h5>
                                <small class="text-muted">{{ $index + 1 }}</small>
                            </div>
                            <p class="mb-1">Tempat: {{ $booking->getTempat->nama_tempat }}</p>
                            <p class="mb-1">Ruangan: {{ $booking->ruangan }}</p>
                            <small class="text-muted">Nominal: Rp {{ number_format($booking->biaya, 0, ',', '.') }}</small>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

