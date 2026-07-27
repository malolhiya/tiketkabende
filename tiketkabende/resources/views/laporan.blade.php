<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laporan Penjualan - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

body{
    background:#f5f7f7;
    font-family:'Segoe UI',sans-serif;
}

.topbar{
    background:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.logo{ display:flex; align-items:center; gap:10px; }
.logo img{ width:32px; }
.logo span{ color:#0f9388; font-weight:700; font-size:20px; }

.user-box{ display:flex; align-items:center; gap:10px; }

.circle{
    width:35px; height:35px; border-radius:50%;
    background:#0f9388; color:white;
    display:flex; align-items:center; justify-content:center;
    font-weight:bold;
}

.content{ padding:30px; max-width:1300px; margin:0 auto; }

.hero-card{
    background:white; border-radius:20px; padding:25px 30px;
    box-shadow:0 3px 15px rgba(0,0,0,.05); margin-bottom:25px;
}

.hero-card h2{ font-family: Georgia, 'Times New Roman', serif; font-weight:700; }

.stat-card{
    background:white; border-radius:18px; padding:20px;
    box-shadow:0 3px 15px rgba(0,0,0,.05);
    display:flex; align-items:center; gap:15px;
}

.stat-icon{
    width:50px; height:50px; border-radius:14px;
    display:flex; align-items:center; justify-content:center;
    font-size:20px; color:white;
}

.stat-number{ font-size:26px; font-weight:bold; }
.stat-label{ font-size:13px; color:#777; }

.nav-pills-custom{ display:flex; gap:10px; flex-wrap:wrap; margin:25px 0; }

.nav-pills-custom a{
    background:white; color:#333; padding:10px 18px;
    border-radius:30px; text-decoration:none; font-weight:600; font-size:14px;
    box-shadow:0 2px 8px rgba(0,0,0,.05);
}

.nav-pills-custom a.active{ background:#0f9388; color:white; }

/* Tombol export */

.export-bar{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.btn-export{
    border:none;
    padding:10px 20px;
    border-radius:10px;
    font-weight:600;
    font-size:14px;
    color:white;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

.btn-excel{ background:#16a34a; }
.btn-excel:hover{ background:#128038; color:white; }

.btn-csv{ background:#0f9388; }
.btn-csv:hover{ background:#0c7d73; color:white; }

.btn-print{ background:#eef0f2; color:#333; }
.btn-print:hover{ background:#e2e5e8; color:#333; }

.table-card{
    background:white; border-radius:20px; padding:25px;
    box-shadow:0 3px 15px rgba(0,0,0,.05);
}

.table-card h4{ font-family: Georgia, 'Times New Roman', serif; font-weight:700; margin-bottom:20px; }

/* Kartu ringkasan laporan */

.ringkasan-box{
    border-radius:16px;
    padding:20px 22px;
    color:white;
}

.ringkasan-box .label{ font-size:13px; opacity:.9; font-weight:600; }
.ringkasan-box .value{ font-size:26px; font-weight:700; margin-top:6px; }

.bg-hari{ background:#3b82f6; }
.bg-bulan{ background:#22c55e; }
.bg-transaksi{ background:#f59e0b; }

.search-box{
    position:relative;
    margin:22px 0 18px;
}

.search-box input{
    width:100%;
    padding:12px 16px 12px 40px;
    border-radius:10px;
    border:1px solid #e2e5e8;
    font-size:14px;
}

.search-box .ic{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    color:#999;
}

table th{ color:#777; font-size:12px; text-transform:uppercase; border-bottom:2px solid #eee; }

.status-confirm{ background:#d8ffe6; color:#008f3d; padding:5px 12px; border-radius:20px; font-size:12px; white-space:nowrap; }
.status-wait{ background:#fff0d7; color:#d97b00; padding:5px 12px; border-radius:20px; font-size:12px; white-space:nowrap; }
.status-cancel{ background:#fee2e2; color:#dc2626; padding:5px 12px; border-radius:20px; font-size:12px; white-space:nowrap; }
.status-refund{ background:#fef3c7; color:#a16207; padding:5px 12px; border-radius:20px; font-size:12px; white-space:nowrap; }

.kode-link{ color:#0f9388; font-weight:700; text-decoration:none; }
.kode-link:hover{ text-decoration:underline; }

</style>
</head>
<body>

<div class="topbar">
<div class="logo">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">
<span>Wisata Ende</span>
</div>

<div class="user-box">
<div class="circle">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
{{ Auth::user()->name }}
</div>
</div>

<div class="content">

<div class="hero-card">
<h2>Dashboard Administrator</h2>
<p class="mb-0 text-muted">Kelola sistem <b style="color:#0f9388;">E-Ticketing Wisata Ende</b></p>
</div>

<div class="row g-3 mb-2">

<div class="col-md-3">
<div class="stat-card">
<div class="stat-icon" style="background:#3b82f6;">🎫</div>
<div>
<div class="stat-number">{{ $totalPemesanan }}</div>
<div class="stat-label">Total Pemesanan</div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<div class="stat-icon" style="background:#22c55e;">👤</div>
<div>
<div class="stat-number">{{ $totalPengguna }}</div>
<div class="stat-label">Total Pengguna</div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<div class="stat-icon" style="background:#f59e0b;">🏔</div>
<div>
<div class="stat-number">{{ $totalDestinasi }}</div>
<div class="stat-label">Destinasi</div>
</div>
</div>
</div>

<div class="col-md-3">
<div class="stat-card">
<div class="stat-icon" style="background:#ef4444;">💰</div>
<div>
<div class="stat-number">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
<div class="stat-label">Pendapatan</div>
</div>
</div>
</div>

</div>

<div class="nav-pills-custom">
<a href="/dashboard-admin">🎫 Kelola Pemesanan</a>
<a href="/admin/destinasi">🏠 Kelola Destinasi</a>
<a href="/admin/pengguna">👤 Kelola Pengguna</a>
<a href="/admin/metode-pembayaran">💳 Metode Pembayaran</a>
<a href="/admin/laporan" class="active">📊 Laporan</a>
<a href="/">🏡 Ke Beranda</a>
<a href="/logout">🚪 Keluar</a>
</div>

<!-- TOMBOL EXPORT -->

<div class="export-bar">
<a href="/admin/laporan/export-excel" class="btn-export btn-excel">📗 Export ke Excel</a>
<a href="/admin/laporan/export-csv" class="btn-export btn-csv">📄 Export ke CSV</a>
<a href="/admin/laporan/print" target="_blank" class="btn-export btn-print">🖨 Print Laporan</a>
</div>

<div class="table-card">

<h4>Laporan</h4>

<div class="row g-3 mb-2">

<div class="col-md-4">
<div class="ringkasan-box bg-hari">
<div class="label">Penjualan Hari Ini</div>
<div class="value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</div>
</div>
</div>

<div class="col-md-4">
<div class="ringkasan-box bg-bulan">
<div class="label">Penjualan Bulan Ini</div>
<div class="value">Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}</div>
</div>
</div>

<div class="col-md-4">
<div class="ringkasan-box bg-transaksi">
<div class="label">Total Transaksi</div>
<div class="value">{{ $totalTransaksi }}</div>
</div>
</div>

</div>

<h5 class="mt-4 mb-2">Riwayat Transaksi</h5>

<div class="search-box">
<span class="ic">🔍</span>
<input type="text" id="cariTransaksi" placeholder="Cari nama pengguna atau kode pemesanan..." onkeyup="filterTabel()">
</div>

<div class="table-responsive">
<table class="table align-middle" id="tabelLaporan">
<thead>
<tr>
<th>Tanggal</th>
<th>Kode Booking</th>
<th>Nama</th>
<th>Destinasi</th>
<th>Jumlah</th>
<th>Total</th>
<th>Status</th>
</tr>
</thead>
<tbody>

@forelse($bookings as $b)
<tr>
<td>{{ \Carbon\Carbon::parse($b->tanggal)->format('j/n/Y') }}</td>
<td><a href="/tiket/{{ $b->id }}" class="kode-link">{{ $b->kode_booking }}</a></td>
<td>{{ $b->user->name ?? '-' }}</td>
<td>{{ $b->destinasi }}</td>
<td>{{ $b->jumlah }} tiket</td>
<td>Rp {{ number_format($b->total, 0, ',', '.') }}</td>
<td>
@if($b->status == 'dikonfirmasi')
<span class="status-confirm">✔ Dikonfirmasi</span>
@elseif($b->status == 'menunggu')
<span class="status-wait">⌛ Menunggu</span>
@elseif($b->status == 'refund')
<span class="status-refund">↩ Direfund</span>
@else
<span class="status-cancel">✕ {{ ucfirst($b->status) }}</span>
@endif
</td>
</tr>
@empty
<tr>
<td colspan="7" class="text-center text-muted py-4">Belum ada transaksi.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>

</div>

<script>

function filterTabel(){
    const kata = document.getElementById('cariTransaksi').value.toLowerCase();
    const baris = document.querySelectorAll('#tabelLaporan tbody tr');

    baris.forEach(function(tr){
        const teks = tr.innerText.toLowerCase();
        tr.style.display = teks.includes(kata) ? '' : 'none';
    });
}

</script>

</body>
</html>