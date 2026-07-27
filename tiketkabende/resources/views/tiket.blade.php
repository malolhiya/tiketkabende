<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>E-Tiket Wisata Ende</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

body{
    background:#f5f7fa;
    font-family:'Segoe UI',sans-serif;
}

.page-title{
    max-width:480px;
    margin:30px auto 15px;
    padding:0 15px;
    font-weight:700;
    font-size:22px;
}

.ticket-box{
    max-width:480px;
    margin:0 auto 40px;
    background:white;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
    overflow:hidden;
}

.ticket-header{
    background:linear-gradient(90deg,#0f9388,#d97842);
    color:white;
    padding:18px 20px;
}

.ticket-header small{
    opacity:.9;
    display:block;
}

.ticket-header .flag{
    float:right;
    font-size:22px;
}

.ticket-body{
    padding:20px;
}

.badge-valid{
    background:#d8ffe6;
    color:#008f3d;
    padding:4px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
    margin-bottom:10px;
}

.qr-box{
    text-align:center;
}

.qr-box img{
    width:150px;
    height:150px;
}

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-top:20px;
}

.info-grid .label{
    font-size:12px;
    color:#888;
    text-transform:uppercase;
}

.info-grid .value{
    font-weight:700;
    color:#0f9388;
}

.note-text{
    font-size:12px;
    color:#888;
    text-align:center;
    margin-top:20px;
    border-top:1px dashed #ddd;
    padding-top:15px;
}

.action-buttons{
    display:flex;
    gap:10px;
    padding:0 20px 20px;
}

.btn-close-custom{
    flex:1;
    background:#eef0f2;
    border:none;
    padding:10px;
    border-radius:8px;
    font-weight:600;
}

.btn-print-custom{
    flex:1;
    background:#0f9388;
    color:white;
    border:none;
    padding:10px;
    border-radius:8px;
    font-weight:600;
}

.btn-print-custom:hover{
    background:#0c7d73;
    color:white;
}

@media print{
    body{ background:white; }
    .page-title, .action-buttons{ display:none !important; }
    .ticket-box{ box-shadow:none; margin:0; }
}

</style>
</head>
<body>

<div class="page-title text-center">
📱 E-Ticket Wisata Ende
</div>

<div class="ticket-box">

<div class="ticket-header">
<b>E-TICKET WISATA</b>
<small>Kabupaten Ende – NTT</small>
</div>

<div class="ticket-body">

<h4>{{ $booking->destinasi }}</h4>

<span class="badge-valid">✔ Tiket Valid</span>

<div class="qr-box my-3">
<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode(url('/verifikasi/'.$booking->kode_booking)) }}" alt="QR Code Tiket">
</div>

<div class="info-grid">

<div>
<div class="label">Kode Booking</div>
<div class="value">{{ $booking->kode_booking }}</div>
</div>

<div>
<div class="label">Nama Pengunjung</div>
<div class="value" style="color:#333;">{{ $booking->user->name ?? '-' }}</div>
</div>

<div>
<div class="label">Tanggal Kunjungan</div>
<div class="value" style="color:#333;">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}</div>
</div>

<div>
<div class="label">Jumlah</div>
<div class="value" style="color:#333;">{{ $booking->jumlah }} orang</div>
</div>

<div>
<div class="label">Total Pembayaran</div>
<div class="value">Rp {{ number_format($booking->total, 0, ',', '.') }}</div>
</div>

<div>
<div class="label">Tanggal Pemesanan</div>
<div class="value" style="color:#333;">{{ $booking->created_at->format('d/m/Y') }}</div>
</div>

</div>

<div class="note-text">
Scan QR Code ini di halaman petugas — sistem akan langsung menampilkan status keabsahan tiket. Jika QR sulit dipindai, petugas juga bisa memasukkan kode <b>{{ $booking->kode_booking }}</b> secara manual di halaman verifikasi.
</div>

</div>

<div class="action-buttons">
<button type="button" class="btn-close-custom" onclick="window.close()">Tutup</button>
<button type="button" class="btn-print-custom" onclick="window.print()">🖨 Print</button>
</div>

</div>

</body>
</html>