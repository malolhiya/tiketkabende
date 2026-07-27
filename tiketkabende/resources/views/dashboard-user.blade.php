<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard Saya - Wisata Ende</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

*{
    box-sizing:border-box;
}

body{
    background:#f1f4f7;
    font-family:'Segoe UI',sans-serif;
    margin:0;
}

.wrapper{
    display:flex;
    min-height:100vh;
}

.sidebar{
    width:230px;
    background:#0f1b17;
    color:#cfd8d5;
    flex-shrink:0;
    padding:22px 16px;
}

.sidebar .logo{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:30px;
    padding-left:4px;
}

.sidebar .logo img{
    width:32px;
    height:32px;
    border-radius:8px;
}

.sidebar .logo span{
    color:#fff;
    font-weight:700;
    font-size:18px;
    font-family:Georgia,'Times New Roman',serif;
}

.sidebar .menu-label{
    font-size:11px;
    letter-spacing:1px;
    color:#6b7a75;
    font-weight:700;
    margin:18px 6px 8px;
    text-transform:uppercase;
}

.sidebar a.menu-item{
    display:flex;
    align-items:center;
    gap:10px;
    color:#c4cdc9;
    text-decoration:none;
    padding:10px 12px;
    border-radius:10px;
    font-size:14.5px;
    font-weight:500;
    margin-bottom:4px;
}

.sidebar a.menu-item:hover{
    background:#182722;
    color:#fff;
}

.sidebar a.menu-item.active{
    background:#0f9388;
    color:#fff;
    font-weight:600;
}

.sidebar a.menu-item .ic{
    width:18px;
    text-align:center;
}

.main-content{
    flex:1;
    min-width:0;
}

.topbar{
    background:#fff;
    padding:18px 32px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.topbar h4{
    font-weight:700;
    margin:0;
    font-family:Georgia,'Times New Roman',serif;
}

.topbar .user-box{
    display:flex;
    align-items:center;
    gap:10px;
}

.topbar .user-circle{
    width:34px;
    height:34px;
    border-radius:50%;
    background:#0f9388;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:14px;
}

.topbar .user-email{
    color:#333;
    font-size:14.5px;
}

.content-area{
    padding:28px 32px;
}

.stat-card{
    background:#fff;
    border-radius:16px;
    padding:18px 20px;
    box-shadow:0 3px 14px rgba(0,0,0,.05);
    display:flex;
    align-items:center;
    gap:14px;
    height:100%;
}

.stat-icon{
    width:46px;
    height:46px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    flex-shrink:0;
}

.stat-icon.bg-total{ background:#e7edff; color:#3b6df0; }
.stat-icon.bg-menunggu{ background:#fdecd2; color:#c8830f; }
.stat-icon.bg-konfirmasi{ background:#d9f5e3; color:#1c9a55; }
.stat-icon.bg-pengeluaran{ background:#fde3df; color:#e0533f; }

.stat-value{
    font-size:24px;
    font-weight:700;
    line-height:1.1;
}

.stat-label{
    color:#6b7280;
    font-size:13px;
    margin-top:2px;
}

.panel{
    background:#fff;
    border-radius:16px;
    box-shadow:0 3px 14px rgba(0,0,0,.05);
    margin-top:24px;
}

.panel-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:22px 24px 18px;
}

.panel-header h5{
    font-weight:700;
    margin:0;
    font-family:Georgia,'Times New Roman',serif;
}

.btn-new{
    background:#0f9388;
    color:#fff;
    border:none;
    padding:9px 18px;
    border-radius:9px;
    font-weight:600;
    font-size:14px;
    text-decoration:none;
}

.btn-new:hover{
    background:#0c7d73;
    color:#fff;
}

table.table-bookings{
    width:100%;
    border-collapse:collapse;
}

table.table-bookings thead th{
    background:#f4f6f8;
    color:#6b7280;
    font-size:12px;
    letter-spacing:.5px;
    text-transform:uppercase;
    font-weight:700;
    padding:12px 24px;
    border-top:1px solid #eef0f2;
    border-bottom:1px solid #eef0f2;
    text-align:left;
    white-space:nowrap;
}

table.table-bookings tbody td{
    padding:16px 24px;
    border-bottom:1px solid #f0f2f4;
    font-size:14.5px;
    vertical-align:middle;
}

.kode-link{
    color:#0f9388;
    font-weight:700;
    text-decoration:none;
}

.kode-link:hover{
    text-decoration:underline;
}

.total-cell{
    font-weight:600;
}

.badge-status{
    padding:5px 12px;
    border-radius:20px;
    font-weight:600;
    font-size:12.5px;
    white-space:nowrap;
    display:inline-block;
}

.badge-menunggu{ background:#fdecd2; color:#b45309; }
.badge-dikonfirmasi{ background:#d9f5e3; color:#15803d; }
.badge-dibatalkan{ background:#fde3df; color:#b91c1c; }
.badge-refund{ background:#fde3df; color:#b91c1c; }
.badge-ditolak{ background:#fde3df; color:#b91c1c; }

.btn-tiket{
    background:#3b6df0;
    color:#fff;
    border:none;
    padding:7px 16px;
    border-radius:8px;
    font-size:13.5px;
    font-weight:600;
    text-decoration:none;
    white-space:nowrap;
    display:inline-block;
}

.btn-tiket:hover{
    background:#2f5bd1;
    color:#fff;
}

.btn-batal{
    background:#e0533f;
    color:#fff;
    border:none;
    padding:7px 16px;
    border-radius:8px;
    font-size:13.5px;
    font-weight:600;
    white-space:nowrap;
}

.btn-batal:hover{
    background:#c8432f;
    color:#fff;
}

.btn-bayar-ulang{
    background:#f59e0b;
    color:#fff;
    border:none;
    padding:7px 16px;
    border-radius:8px;
    font-size:13.5px;
    font-weight:600;
    text-decoration:none;
    white-space:nowrap;
    display:inline-block;
}

.btn-bayar-ulang:hover{
    background:#d9820a;
    color:#fff;
}

.btn-info-refund{
    background:none;
    border:none;
    color:#3b6df0;
    font-size:12.5px;
    font-weight:600;
    padding:0;
    text-decoration:underline;
    white-space:nowrap;
}

.empty-state{
    text-align:center;
    color:#6b7280;
    padding:60px 20px;
}

#modalAlasanRefund .modal-content{
    border-radius:16px;
    border:none;
}

@media (max-width:900px){
    .sidebar{ display:none; }
    .content-area{ padding:20px; }
    table.table-bookings{ display:block; overflow-x:auto; }
}

</style>
</head>
<body>

@if(session('success'))
<script>
    window.addEventListener('DOMContentLoaded', function(){
        alert(@json(session('success')));
    });
</script>
@endif

<div class="wrapper">

<div class="sidebar">

<div class="logo">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">
<span>Wisata Ende</span>
</div>

<div class="menu-label">Menu</div>

<a href="/dashboard-user" class="menu-item active">
<span class="ic">🗂️</span> Dashboard Saya
</a>

<a href="/dashboard" class="menu-item">
<span class="ic">🧭</span> Cari Destinasi
</a>

<div class="menu-label">Lainnya</div>

<a href="/" class="menu-item">
<span class="ic">🏠</span> Ke Beranda Publik
</a>

<a href="/logout" class="menu-item">
<span class="ic">🚪</span> Keluar
</a>

</div>

<div class="main-content">

<div class="topbar">
<h4>Dashboard Saya</h4>

<div class="user-box">
<div class="user-circle">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
<span class="user-email">{{ Auth::user()->name }}</span>
</div>
</div>

<div class="content-area">

<div class="row g-3">

<div class="col-md-3 col-6">
<div class="stat-card">
<div class="stat-icon bg-total">🎫</div>
<div>
<div class="stat-value">{{ $total }}</div>
<div class="stat-label">Total Pemesanan</div>
</div>
</div>
</div>

<div class="col-md-3 col-6">
<div class="stat-card">
<div class="stat-icon bg-menunggu">⏳</div>
<div>
<div class="stat-value">{{ $menunggu }}</div>
<div class="stat-label">Menunggu Konfirmasi</div>
</div>
</div>
</div>

<div class="col-md-3 col-6">
<div class="stat-card">
<div class="stat-icon bg-konfirmasi">✅</div>
<div>
<div class="stat-value">{{ $dikonfirmasi }}</div>
<div class="stat-label">Dikonfirmasi</div>
</div>
</div>
</div>

<div class="col-md-3 col-6">
<div class="stat-card">
<div class="stat-icon bg-pengeluaran">💰</div>
<div>
<div class="stat-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
<div class="stat-label">Total Pengeluaran</div>
</div>
</div>
</div>

</div>

<div class="panel">

<div class="panel-header">
<h5>Pemesanan Saya</h5>
<a href="/dashboard" class="btn-new">+ Pesan Tiket Baru</a>
</div>

@if($bookings->count() > 0)

<div style="overflow-x:auto;">
<table class="table-bookings">
<thead>
<tr>
<th>Kode Booking</th>
<th>Destinasi</th>
<th>Tanggal</th>
<th>Jumlah</th>
<th>Total</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>

@foreach($bookings as $booking)
<tr>

<td>
@if($booking->status == 'dikonfirmasi')
<a href="/tiket/{{ $booking->id }}" target="_blank" class="kode-link">{{ $booking->kode_booking }}</a>
@else
<span class="kode-link" style="cursor:default;">{{ $booking->kode_booking }}</span>
@endif
</td>

<td>{{ $booking->destinasi }}</td>

<td>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>

<td>{{ $booking->jumlah }} orang</td>

<td class="total-cell">Rp {{ number_format($booking->total, 0, ',', '.') }}</td>

<td>
@if($booking->status == 'menunggu')
<span class="badge-status badge-menunggu">⏳ Menunggu</span>
@elseif($booking->status == 'dikonfirmasi')
<span class="badge-status badge-dikonfirmasi">✅ Dikonfirmasi</span>
@elseif($booking->status == 'dibatalkan')
<span class="badge-status badge-dibatalkan">✖ Dibatalkan</span>
@elseif($booking->status == 'ditolak')
<span class="badge-status badge-ditolak">✖ Ditolak</span>
@elseif($booking->status == 'refund')
<span class="badge-status badge-refund">↩ Refund</span>
<br>
<button type="button" class="btn-info-refund mt-1"
    onclick="lihatAlasanRefund('{{ addslashes($booking->catatan_refund) }}', {{ $booking->nominal_kurang ?? 0 }})">
    ℹ️ Lihat Alasan
</button>
@endif
</td>

<td>
@if($booking->status == 'dikonfirmasi')
<a href="/tiket/{{ $booking->id }}" target="_blank" class="btn-tiket">🎫 Tiket</a>
@elseif($booking->status == 'menunggu')
<form action="/booking/{{ $booking->id }}/batal" method="POST" onsubmit="return confirm('Batalkan pemesanan ini?');" class="d-inline">
@csrf
<button type="submit" class="btn-batal">Batal</button>
</form>
@elseif($booking->status == 'refund' && ($booking->nominal_kurang ?? 0) > 0)
<a href="/bayar-ulang/{{ $booking->id }}" class="btn-bayar-ulang">💳 Bayar Ulang</a>
@else
-
@endif
</td>

</tr>
@endforeach

</tbody>
</table>
</div>

@else

<div class="empty-state">
<h5>Belum ada pemesanan</h5>
<p>Yuk mulai jelajahi destinasi wisata dan pesan tiket pertama Anda.</p>
<a href="/dashboard" class="btn-new">Lihat Destinasi</a>
</div>

@endif

</div>

</div>

</div>

</div>

<!-- MODAL: ALASAN REFUND -->

<div class="modal fade" id="modalAlasanRefund" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">↩ Informasi Refund</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<div id="isiNominalKurang" class="alert alert-warning" style="display:none;"></div>
<p id="isiCatatanRefund" class="mb-0"></p>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function lihatAlasanRefund(catatan, nominalKurang){
    document.getElementById('isiCatatanRefund').innerText = catatan;

    let boxNominal = document.getElementById('isiNominalKurang');
    if(nominalKurang > 0){
        boxNominal.style.display = 'block';
        boxNominal.innerText = '⚠️ Anda perlu menambah pembayaran sebesar Rp ' + nominalKurang.toLocaleString('id-ID') + '. Klik tombol "Bayar Ulang" pada baris pemesanan ini.';
    } else {
        boxNominal.style.display = 'none';
    }

    new bootstrap.Modal(document.getElementById('modalAlasanRefund')).show();
}
</script>

</body>
</html>