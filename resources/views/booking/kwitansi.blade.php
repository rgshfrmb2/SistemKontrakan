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
                       Terimakasih untuk pembayaran anda sebesar <strong>{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}</strong>
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

                    <div class="border-top border-gray-200 mt-2 py-4">
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
                                    Biaya Sewa {{ $booking->ruangan }}
                                </strong>
                                <p class="fs-sm">
                                    {{ $booking->getTempat->alamat_tempat }}
                                    <br>
                                    <a href="mailto:{{ $booking->getTempat->email_tempat }}" class="text-purple">{{ $booking->getTempat->email_tempat }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <table class="table border-bottom border-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Deskripsi</th>
                                <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-0">Periode {{ \Carbon\Carbon::parse($booking->start_date)->locale('id')->translatedFormat('d F Y') }} sampai {{ \Carbon\Carbon::parse($booking->end_date)->locale('id')->translatedFormat('d F Y') }}<br>
                               
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
                                <p class="fs-sm mt-2">{{ Auth::user()->name }}</p>
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
        if (signaturePad.isEmpty()) {
            alert("Silakan tanda tangan terlebih dahulu.");
            return;
        }

        var { jsPDF } = window.jspdf;
        var pdf = new jsPDF();

        pdf.setFontSize(16);
        pdf.text("Hey {{ $booking->nama_pemesan }},", 10, 20);
        pdf.setFontSize(12);
        pdf.text("Terimakasih sudah melakukan pembayaran sebesar {{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }} ", 10, 30);
        pdf.setDrawColor(0, 0, 0);
        pdf.setLineWidth(0.5);
        pdf.line(10, 35, 200, 35);

        pdf.setFontSize(10);
        pdf.text("Nomor Pemesanan", 10, 40);
        pdf.setFontSize(12);
        pdf.text("#{{ $booking->id }}", 10, 45);
        

        pdf.setFontSize(10);
        pdf.text("Tanggal Pembayaran", 200, 40, { align: "right" });
        pdf.setFontSize(12);
        pdf.text("{{ \Carbon\Carbon::parse($booking->tanggal_pembayaran)->locale('id')->translatedFormat('l, d F Y') }}", 200, 45, { align: "right" });

      
    

        pdf.setFontSize(10);
        pdf.text("Atas Nama", 10, 55);
        pdf.setFontSize(12);
        pdf.text("{{ $booking->nama_pemesan }}", 10, 60);
        pdf.setFontSize(10);
        pdf.text("{{ $booking->alamat_pemesan }}", 10, 65);
        pdf.text("{{ $booking->email_pemesan }}", 10, 70);

        pdf.setFontSize(10);
        pdf.text("Perihal Pembayaran", 200, 55, { align: "right" });
        pdf.setFontSize(12);
        pdf.text("Biaya Sewa: {{ $booking->ruangan }}", 200, 60, { align: "right" });
        pdf.setFontSize(10);

        pdf.setDrawColor(0, 0, 0);
        pdf.setLineWidth(0.5);
        pdf.line(10, 75, 200, 75);
      

        

        pdf.setFontSize(10);
        pdf.text("Deskripsi", 10, 85);
        pdf.text("Jumlah", 200, 85, { align: "right" });
        pdf.setFontSize(12);
        pdf.text("Periode {{ \Carbon\Carbon::parse($booking->start_date)->locale('id')->translatedFormat('d F Y') }} sampai {{ \Carbon\Carbon::parse($booking->end_date)->locale('id')->translatedFormat('d F Y') }}", 10, 90);
        pdf.text("{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 150, 90, { align: "right" });

        pdf.setDrawColor(0, 0, 0);
        pdf.setLineWidth(0.5);
        pdf.line(10, 95, 200, 95);

        pdf.setFontSize(10);
        pdf.text("Subtotal", 200, 100, { align: "right" });
        pdf.setFontSize(12);
        pdf.text("{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 200, 105, { align: "right" });

        pdf.setFontSize(14);
        pdf.setTextColor(0, 0, 0);
        pdf.setFont("helvetica", "bold");
        pdf.text("Total", 200, 115, { align: "right" });
        pdf.setFontSize(16);
        pdf.text("{{ 'Rp ' . number_format($booking->biaya, 0, ',', '.') }}", 200, 120, { align: "right" });

        pdf.setFontSize(10);
        pdf.text("Tanda Tangan", 10, 125);
        var imgData = signaturePad.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 10, 130, 50, 20);

        pdf.setFontSize(10);
        pdf.text("{{ Auth::user()->name }}", 10, 155);

        pdf.setDrawColor(0, 0, 0);
        pdf.setLineWidth(0.5);
        pdf.rect(5, 5, 200, 287);

        // Menambahkan background image
        var wmImage = new Image();
        wmImage.src = '{{ asset('img/wm.png') }}';
        wmImage.onload = function() {
            pdf.addImage(wmImage, 'PNG', 0, 0, pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight());
        };
        pdf.save('kwitansi.pdf');

      
    });
</script>
@endsection
