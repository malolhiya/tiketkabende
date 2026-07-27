<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hasil Verifikasi Tiket</title>
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
    text-align:center;
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
    padding:18px 20px;
    color:white;
}

.ticket-header.valid{ background:linear-gradient(90deg,#0f9388,#22c55e); }
.ticket-header.used{ background:linear-gradient(90deg,#6b7280,#9ca3af); }
.ticket-header.invalid{ background:linear-gradient(90deg,#ef4444,#f97316); }

.ticket-header small{
    opacity:.9;
    display:block;
}

.ticket-body{
    padding:25px 20px;
    text-align:center;
}

.status-icon{
    font-size:56px;
    margin-bottom:10px;
}

.status-text{
    font-size:20px;
    font-weight:700;
    margin-bottom:5px;
}

.status-sub{
    color:#777;
    font-size:13px;
    margin-bottom:20px;
}

.info-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-top:20px;
    text-align:left;
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

.btn-checkin{
    width:100%;
    background:#0f9388;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
    margin-top:20px;
}

.btn-checkin:hover{
    background:#0c7d73;
    color:white;
}

.btn-kembali{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#0f9388;
    font-weight:600;
    text-decoration:none;
}

.checked-in-box{
    background:#f3f4f6;
    border-radius:10px;
    padding:12px;
    margin-top:20px;
    font-size:13px;
    color:#4b5563;
}

</style>
</head>
<body>

<div class="page-title">🔍 Hasil Verifikasi Tiket</div>

<div class="ticket-box">

@if(!$booking)

<div class="ticket-header invalid">
<b>TIKET TIDAK VALID</b>
<small>Kode booking tidak ditemukan</small>
</div>

<div class="ticket-body">
<div class="status-icon">❌</div>
<div class="status-text" style="color:#ef4444;">Kode Tidak Ditemukan</div>
<div class="status-sub">Kode booking <b>{{ $kode }}</b> tidak terdaftar di sistem. Periksa kembali kode atau QR yang dipindai.</div>
</div>

@elseif($booking->status !== 'dikonfirmasi')

<div class="ticket-header invalid">
<b>TIKET BELUM VALID</b>
<small>{{ $booking->destinasi }}</small>
</div>

<div class="ticket-body">
<div class="status-icon">⚠️</div>
<div class="status-text" style="color:#f97316;">
@if($booking->status === 'menunggu')
    Menunggu Konfirmasi Admin
@elseif($booking->status === 'ditolak')
    Pemesanan Ditolak
@elseif($booking->status === 'dibatalkan')
    Pemesanan Dibatalkan
@elseif($booking->status === 'refund')
    Sedang Proses Refund
@endif
</div>
<div class="status-sub">Tiket dengan kode <b>{{ $booking->kode_booking }}</b> belum bisa digunakan untuk masuk lokasi wisata.</div>
</div>

@elseif($booking->checked_in_at)

<div class="ticket-header used">
<b>TIKET SUDAH DIGUNAKAN</b>
<small>{{ $booking->destinasi }}</small>
</div>

<div class="ticket-body">
<div class="status-icon">🔁</div>
<div class="status-text" style="color:#6b7280;">Sudah Check-in Sebelumnya</div>
<div class="status-sub">Tiket ini sudah pernah dipindai dan digunakan untuk masuk.</div>

<div class="checked-in-box">
⏱ Check-in pada: <b>{{ $booking->checked_in_at->translatedFormat('l, d F Y H:i') }}</b> WITA
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
<div class="value" style="color:#333;">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</div>
</div>
<div>
<div class="label">Jumlah</div>
<div class="value" style="color:#333;">{{ $booking->jumlah }} orang</div>
</div>
</div>

</div>

@else

<div class="ticket-header valid">
<b>TIKET VALID</b>
<small>{{ $booking->destinasi }}</small>
</div>

<div class="ticket-body">
<div class="status-icon">✅</div>
<div class="status-text" style="color:#0f9388;">Tiket Sah &amp; Belum Digunakan</div>
<div class="status-sub">Silakan izinkan pengunjung masuk, lalu tandai tiket sebagai sudah digunakan.</div>

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
<div class="value" style="color:#333;">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</div>
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

<form action="/verifikasi/{{ $booking->kode_booking }}/checkin" method="POST" onsubmit="return confirm('Tandai tiket ini sebagai sudah digunakan? Tindakan ini tidak bisa dibatalkan.')">
@csrf
<button type="submit" class="btn-checkin">✔ Tandai Sudah Digunakan</button>
</form>

</div>

@endif

</div>

<a href="/verifikasi" class="btn-kembali">🔍 Cek tiket lain</a>

</body>
</html>