@extends('layouts.master')

@section('content')
<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-body p-5">
                    <h2>
                        Hey {{ $booking->nama_pemesan }},
                    </h2>
                    <p class="fs-sm">
                        Ini adalah kwitansi untuk pembayaran sebesar <strong>{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</strong> yang Anda lakukan.
                    </p>

                    <div class="border-top border-gray-200 pt-4 mt-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-muted mb-2">Nomor Pemesanan</div>
                                <strong>#{{ $booking->id }}</strong>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="text-muted mb-2">Tanggal Pembayaran</div>
                                <strong>{{ \Carbon\Carbon::parse($booking->tanggal_pembayaran)->locale('id')->translatedFormat('l, d F Y') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="border-top border-gray-200 mt-4 py-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-muted mb-2">Atas Nama</div>
                                <strong>
                                    {{ $booking->nama_pemesan }}
                                </strong>
                                <p class="fs-sm">
                                    {{ $booking->alamat_pemesan }}
                                    <br>
                                    <a href="mailto:{{ $booking->email_pemesan }}" class="text-purple">{{ $booking->email_pemesan }}</a>
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="text-muted mb-2">Perihal Pembayaran</div>
                                <strong>
                                    Biaya Sewa <br> {{ $booking->getTempat->nama_tempat }} - {{ $booking->ruangan }}
                                </strong>
                                <p class="fs-sm">
                                    {{ $booking->getTempat->alamat_tempat }}
                                    <br>
                                    <a href="mailto:{{ $booking->getTempat->email_tempat }}" class="text-purple">{{ $booking->getTempat->email_tempat }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <table class="table border-bottom border-gray-200 mt-3">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Deskripsi</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-0">Biaya Pemesanan <br>
                                <span class="text-muted">Periode {{ \Carbon\Carbon::parse($booking->start_date)->locale('id')->translatedFormat('d F Y') }} sampai {{ \Carbon\Carbon::parse($booking->end_date)->locale('id')->translatedFormat('d F Y') }}</span>
                                </td>
                                <td class="text-end px-0">{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-5">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted">Tanda Tangan Penerima:</p>
                                <canvas id="signature-pad" class="signature-pad" width=200 height=100></canvas>
                            </div>
                            <div>
                                <p class="text-muted me-3">Subtotal:</p>
                                <span>{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div></div>
                            <div>
                                <h5 class="me-3">Total:</h5>
                                <h5 class="text-success">{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button id="download-pdf" class="btn btn-primary">Download PDF</button>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('download-pdf').addEventListener('click', function () {
        var { jsPDF } = window.jspdf;
        var doc = new jsPDF();

        doc.text("Kwitansi Pembayaran", 10, 10);
        doc.text("Hey {{ $booking->nama_pemesan }},", 10, 20);
        doc.text("Ini adalah kwitansi untuk pembayaran sebesar {{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }} yang Anda lakukan.", 10, 30);
        doc.text("Nomor Pemesanan: #{{ $booking->id }}", 10, 40);
        doc.text("Tanggal Pembayaran: {{ \Carbon\Carbon::parse($booking->tanggal_pembayaran)->locale('id')->translatedFormat('l, d F Y') }}", 10, 50);
        doc.text("Atas Nama: {{ $booking->nama_pemesan }}", 10, 60);
        doc.text("Alamat Pemesan: {{ $booking->alamat_pemesan }}", 10, 70);
        doc.text("Email Pemesan: {{ $booking->email_pemesan }}", 10, 80);
        doc.text("Perihal Pembayaran: Biaya Sewa {{ $booking->getTempat->nama_tempat }} - {{ $booking->ruangan }}", 10, 90);
        doc.text("Alamat Tempat: {{ $booking->getTempat->alamat_tempat }}", 10, 100);
        doc.text("Email Tempat: {{ $booking->getTempat->email_tempat }}", 10, 110);
        doc.text("Biaya Pemesanan: {{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 10, 120);
        doc.text("Periode: {{ \Carbon\Carbon::parse($booking->start_date)->locale('id')->translatedFormat('d F Y') }} sampai {{ \Carbon\Carbon::parse($booking->end_date)->locale('id')->translatedFormat('d F Y') }}", 10, 130);
        doc.text("Subtotal: {{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 10, 140);
        doc.text("Total: {{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 10, 150);

        var imgData = signaturePad.toDataURL('image/png');
        doc.addImage(imgData, 'PNG', 10, 160, 50, 20);

        doc.save('kwitansi.pdf');
    });
</script>
@endsection
