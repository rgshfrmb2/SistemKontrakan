@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="card">
          <div class="card-header">
            <h4>Buat Tempat Baru</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('tempats.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Tempat</label>
                <input type="text" name="nama_tempat" class="form-control" id="nama" required>
              </div>
              
              <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection