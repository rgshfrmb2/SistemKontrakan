@extends('layouts.master')

@section('content')

<div class="container mt-4">
    <div class="row">
    <div class="d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
        <div class="col-md-12 d-flex justify-content-end mb-3">
            <a href="{{ route('tempats.create') }}" class="btn btn-success">Create </a>
        </div>
        
        @foreach($tempats as $tempat)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body">
                    <h5 class="card-title">{{ $tempat->nama_tempat }}</h5>
                    <p class="card-text">Sudah diisi oleh {{ $tempat->countBooking($tempat->id) }} orang.</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('bookings.index', ['tempat_id' => $tempat->id]) }}" class="btn btn-info"><i class="fas fa-info-circle"></i> Detail</a>
                        <a href="{{ route('tempats.edit', $tempat->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal{{ $tempat->id }}">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmPasswordModal{{ $tempat->id }}" tabindex="-1" aria-labelledby="confirmPasswordModalLabel{{ $tempat->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmPasswordModalLabel{{ $tempat->id }}">Konfirmasi Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tempats.destroy', $tempat->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection



