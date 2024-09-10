@extends('layouts.master')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Edit Penyewa</h6>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
          <div class="card-body">
            <form action="{{ route('bookings.update', ['id' => $booking->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="nama_pemesan" class="form-label">Atas Nama</label>
                <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="{{ $booking->nama_pemesan }}" required>
              </div>
              <div class="mb-3">
                <label for="biaya" class="form-label">Biaya</label>
                <input type="number" class="form-control" id="biaya" name="biaya" value="{{ $booking->biaya }}" required>
              </div>
    
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $booking->start_date }}" required>
              </div>
              <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $booking->end_date }}" required>
              </div>
              <div class="mb-3">
                <label for="tanggal_jatuh_tempo" class="form-label">Pengingat Admin</label>
                <input type="date" class="form-control" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" value="{{ $booking->tanggal_jatuh_tempo }}" required>
              </div>
              <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ $booking->tanggal_pembayaran }}">
              </div>
              <div class="mb-3">
                <label for="tempat_id" class="form-label">Tempat</label>
                <input type="text" class="form-control" id="tempat_id" name="tempat_id" value="{{ $booking->tempat_id }}" readonly>
              </div>
              <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <input type="text" class="form-control" id="ruangan" name="ruangan" value="{{ $booking->ruangan }}" required>
              </div>

              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="Baru" {{ $booking->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                  <option value="Perpanjang" {{ $booking->status == 'Perpanjang' ? 'selected' : '' }}>Perpanjang</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
