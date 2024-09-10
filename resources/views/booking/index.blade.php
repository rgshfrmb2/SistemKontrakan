@extends('layouts.master')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Rekapan Pembayaran Sewa</h6> 
            
          </div>
          <br>
          
          <div class="card-body px-0 pt-0 pb-2">
          <div class="d-flex justify-content-end mb-3">
              <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
              </a>
            </div>
            <div class="table-responsive p-0">

              <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('bookings.create') }}" class="btn btn-primary">Buat Pemesanan Baru</a>
                <button class="btn btn-success ms-2" onclick="downloadExcel()">Download Excel</button>
              </div>
       
              <table class="table align-items-center mb-0" id="kontrakanTable">
                <thead>
                  <tr>
                    <th class="text-black text-xs font-weight-bolder">No</th>
                    <th class="text-black text-xs font-weight-bolder">Atas Nama</th>
                    <th class="text-black text-xs font-weight-bolder">Biaya</th>
                    <th class="text-black text-xs font-weight-bolder">Start Date</th>
                    <th class="text-black text-xs font-weight-bolder">End Date</th>
                    <th class="text-black text-xs font-weight-bolder">Pengingat Admin</th>
                    <th class="text-black text-xs font-weight-bolder">Tanggal Pembayaran</th>
                    <th class="text-black text-xs font-weight-bolder">Tempat</th>
                    <th class="text-black text-xs font-weight-bolder">Ruangan</th>
                    <th class="text-black text-xs font-weight-bolder">Status</th>
                    <th class="text-black text-xs font-weight-bolder">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $index => $booking)
                  <tr>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $index + 1 }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $booking->nama_pemesan }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</span>
                    </td>
             
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $booking->start_date }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">{{ $booking->end_date }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">
                        {{ $booking->tanggal_jatuh_tempo }}
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-black text-xs font-weight-bold">
                        {{ $booking->tanggal_pembayaran ?? 'Belum Bayar' }}
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      
                      <span class="text-black text-xs font-weight-bold">{{ $booking->getTempat->nama_tempat }}</span>
                    </td>

                    <td class="align-middle text-center">
                      
                      <span class="text-black text-xs font-weight-bold">{{ $booking->ruangan }}</span>
                    </td>

                    <td class="align-middle text-center">
                      
                      <span class="text-black text-xs font-weight-bold">{{ $booking->status }}</span>
                    </td>


                    <td class="align-middle text-center">
                      <a href="{{ route('bookings.edit', $booking->id) }}" class="text-primary"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('bookings.destroy', $booking->id) }}" class="text-danger mx-2" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')"><i class="fa fa-trash"></i></a>
                      <a href="{{ route('notes.index', ['booking_id' => $booking->id]) }}"><i class="fa fa-file-invoice"></i></a>
                      <a href="{{ route('bookings.kwitansi', $booking->id) }}" class="text-warning"><i class="fa fa-print"></i></a>
                    </td>
                  </tr>
                  @endforeach

                  <tr>
                    <th class="text-black text-xs font-weight-bolder text-center" colspan="5">Total Pemasukan</th>
                    <th class="text-center text-black text-xs font-weight-bolder" colspan="5">Per Tanggal</th>
                  </tr>
                  <tr>
                    <td class="align-middle text-center" colspan="5">
                      <span class="text-black text-xs font-weight-bold" id="totalPemasukan">{{ 'Rp ' . number_format($bookings->whereNotNull('tanggal_pembayaran')->sum('biaya'), 0, ',', '.') }}</span>
                    </td>

                    <td class="align-middle text-center" colspan="5">
                      <input type="date" class="form-control text-xs" id="filterDate" onchange="filterTableByPaymentDate()" style="margin-top: 10px;">
                    </td>
                  </tr>
                  <script>
                    function filterTableByPaymentDate() {
                      var filterDate = document.getElementById('filterDate').value;
                      var totalPemasukanElement = document.getElementById('totalPemasukan');
                      var bookings = @json($bookings);

                      var filteredBookings = bookings.filter(function(booking) {
                        return booking.tanggal_pembayaran === filterDate;
                      });

                      var totalPemasukan = filteredBookings.reduce(function(sum, booking) {
                        return sum + booking.biaya;
                      }, 0);

                      totalPemasukanElement.textContent = 'Rp ' + totalPemasukan.toLocaleString('id-ID');
                    }

                    function downloadExcel() {
                      var table = document.getElementById('kontrakanTable');
                      var rows = table.querySelectorAll('tr');
                      var data = [];

                      // Add header row
                      var headerRow = rows[0];
                      var headerCols = headerRow.querySelectorAll('th');
                      var headerData = [];
                      headerCols.forEach(function(col, index) {
                        if (index !== headerCols.length - 1) { // Exclude the last column (Aksi)
                          headerData.push(col.innerText);
                        }
                      });
                      data.push(headerData);

                      // Add data rows
                      for (var i = 1; i < rows.length - 2; i++) { // Exclude the last two rows (total and filter)
                        var row = rows[i];
                        var cols = row.querySelectorAll('td');
                        var rowData = [];
                        cols.forEach(function(col, index) {
                          if (index !== cols.length - 1) { // Exclude the last column (Aksi)
                            rowData.push(col.innerText);
                          }
                        });
                        data.push(rowData);
                      }

                      var workbook = XLSX.utils.book_new();
                      var worksheet = XLSX.utils.aoa_to_sheet(data);

                      // Set header style (blue background)
                      var range = XLSX.utils.decode_range(worksheet['!ref']);
                      for (var C = range.s.c; C <= range.e.c; ++C) {
                        var address = XLSX.utils.encode_cell({r: 0, c: C});
                        var cell = worksheet[address];
                        if (!cell) continue;
                        cell.s = {
                          fill: {fgColor: {rgb: "0000FF"}},
                          font: {color: {rgb: "FFFFFF"}}
                        };
                      }

                      // Auto-fit columns
                      var range = XLSX.utils.decode_range(worksheet['!ref']);
                      for (var C = range.s.c; C <= range.e.c; ++C) {
                        var max_width = 0;
                        for (var R = range.s.r; R <= range.e.r; ++R) {
                          var cell_address = {c:C, r:R};
                          var cell_ref = XLSX.utils.encode_cell(cell_address);
                          if (!worksheet[cell_ref]) continue;
                          var cell_value = worksheet[cell_ref].v;
                          max_width = Math.max(max_width, cell_value ? cell_value.toString().length : 0);
                        }
                        worksheet['!cols'] = worksheet['!cols'] || [];
                        worksheet['!cols'][C] = { wch: max_width };
                      }

                      // Set all borders
                      for (var R = range.s.r; R <= range.e.r; ++R) {
                        for (var C = range.s.c; C <= range.e.c; ++C) {
                          var cell_address = {c:C, r:R};
                          var cell_ref = XLSX.utils.encode_cell(cell_address);
                          if (!worksheet[cell_ref]) worksheet[cell_ref] = {};
                          worksheet[cell_ref].s = worksheet[cell_ref].s || {};
                          worksheet[cell_ref].s.border = {
                            top: {style: 'thin', color: {auto: 1}},
                            right: {style: 'thin', color: {auto: 1}},
                            bottom: {style: 'thin', color: {auto: 1}},
                            left: {style: 'thin', color: {auto: 1}}
                          };
                        }
                      }

                      // Set header fill color to blue
                      var headerRange = XLSX.utils.decode_range(worksheet['!ref']);
                      for (var C = headerRange.s.c; C <= headerRange.e.c; ++C) {
                        var address = XLSX.utils.encode_cell({r: 0, c: C});
                        if (!worksheet[address]) worksheet[address] = {};
                        worksheet[address].s = worksheet[address].s || {};
                        worksheet[address].s.fill = {fgColor: {rgb: "0000FF"}};
                        worksheet[address].s.font = {color: {rgb: "FFFFFF"}};
                      }

                      XLSX.utils.book_append_sheet(workbook, worksheet, "Rekapan Pembayaran Sewa");

                      // Set the worksheet to have all borders
                      if(!worksheet['!outline']) {
                        worksheet['!outline'] = {};
                      }
                      worksheet['!outline'].borders = true;

                      XLSX.writeFile(workbook, "rekapan_pembayaran_sewa.xlsx");
                    }
                  </script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                </tbody>

                
                <tfoot>
                  

                  
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection