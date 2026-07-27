<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pemesanan Berhasil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f5f7fa;font-family:'Segoe UI',sans-serif;}
.success-box{max-width:500px;margin:60px auto;background:white;padding:35px;border-radius:20px;box-shadow:0 5px 20px rgba(0,0,0,.1);text-align:center;}
.icon-check{width:70px;height:70px;background:#22c55e;border:2px solid #000;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;}
.icon-check svg{width:36px;height:36px;stroke:white;}
h2{font-weight:bold;margin-bottom:10px;}
.subtext{color:#6b7280;margin-bottom:25px;}
.detail-box{background:#f8fafc;border-radius:12px;padding:20px;text-align:left;margin-bottom:25px;}
.detail-box p{display:flex;justify-content:space-between;margin-bottom:10px;}
.detail-box b{color:#0f9388;}
.btn-close-custom{background:#eef0f2;border:none;padding:10px 20px;border-radius:8px;font-weight:bold;}
.btn-dashboard{background:#0f9388;color:white;border:none;padding:10px 20px;border-radius:8px;font-weight:bold;}
.btn-dashboard:hover{background:#0c7d73;color:white;}
</style>
</head>
<body>

<div class="success-box">

<div class="icon-check">
<svg viewBox="0 0 24 24" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
<polyline points="20 6 9 17 4 12"></polyline>
</svg>
</div>

<h2>Pemesanan Berhasil!</h2>
<p class="subtext">Pemesanan Anda telah berhasil. Silahkan tunggu konfirmasi dari admin.</p>

<div class="detail-box">
<p><span>Kode Booking:</span> <b>{{ $booking->kode_booking }}</b></p>
<p><span>Destinasi:</span> <b>{{ $booking->destinasi }}</b></p>
<p><span>Tanggal:</span> <b>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</b></p>
<p><span>Jumlah:</span> <b>{{ $booking->jumlah }} Orang</b></p>
</div>

<div class="d-flex justify-content-center gap-2">
<a href="/dashboard-user" class="btn-close-custom text-decoration-none">Tutup</a>
<a href="/dashboard-user" class="btn-dashboard text-decoration-none">Ke Dashboard</a>
</div>

</div>

</body>
</html>