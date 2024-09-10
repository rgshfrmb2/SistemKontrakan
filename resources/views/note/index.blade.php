@extends('layouts.master')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Rekapan Catatan Pemesanan</h6> 
            
          </div>
          <br>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">

              <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('notes.create') }}" class="btn btn-primary">Buat Catatan Baru</a>
              </div>
              <table class="table align-items-center mb-0" id="catatanTable">
                <thead>
                  <tr>
                    <th class="text-black text-xs font-weight-bolder">No</th>
                    <th class="text-black text-xs font-weight-bolder">Catatan</th>
                    <th class="text-black text-xs font-weight-bolder">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($notes as $index => $note)
                  <tr>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $index + 1 }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $note->catatan }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#confirmEditPasswordModal{{ $note->id }}"><i class="fa fa-edit"></i></a>

                      <!-- Modal -->
                      <div class="modal fade" id="confirmEditPasswordModal{{ $note->id }}" tabindex="-1" aria-labelledby="confirmEditPasswordModalLabel{{ $note->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="confirmEditPasswordModalLabel{{ $note->id }}">Konfirmasi Password</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('notes.edit', $note->id) }}" method="GET">
                                @csrf
                                <div class="mb-3">
                                  <label for="password" class="form-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <a href="#" class="text-danger mx-2" data-bs-toggle="modal" data-bs-target="#confirmPasswordModal{{ $note->id }}"><i class="fa fa-trash"></i></a>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmPasswordModal{{ $note->id }}" tabindex="-1" aria-labelledby="confirmPasswordModalLabel{{ $note->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="confirmPasswordModalLabel{{ $note->id }}">Konfirmasi Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
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
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
