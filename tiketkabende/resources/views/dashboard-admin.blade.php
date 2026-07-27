<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Admin</title>
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

.table-card{
    background:white; border-radius:20px; padding:25px;
    box-shadow:0 3px 15px rgba(0,0,0,.05);
}

.table-card h4{ font-family: Georgia, 'Times New Roman', serif; font-weight:700; margin-bottom:20px; }

table th{ color:#777; font-size:12px; text-transform:uppercase; border-bottom:2px solid #eee; }

.status-confirm{ background:#d8ffe6; color:#008f3d; padding:5px 12px; border-radius:20px; font-size:12px; }
.status-wait{ background:#fff0d7; color:#d97b00; padding:5px 12px; border-radius:20px; font-size:12px; }
.status-cancel{ background:#fee2e2; color:#dc2626; padding:5px 12px; border-radius:20px; font-size:12px; }

.btn-sm-custom{
    border:none; padding:5px 12px; border-radius:8px; font-size:12px;
    color:white; font-weight:600;
}

.btn-ticket{ background:#0f9388; }
.btn-refund{ background:#ef4444; }
.btn-confirm{ background:#22c55e; }
.btn-reject{ background:#ef4444; }
.btn-view{ background:#eef0f2; color:#333; }
.btn-delete{ background:#b91c1c; }

.info-kurang{
    font-size:11px;
    color:#b45309;
    display:block;
    margin-top:3px;
}

#modalBukti .modal-content, #modalRefund .modal-content{
    border-radius:16px; border:none;
}

#modalBukti img{
    width:100%; border-radius:12px;
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
<a href="/dashboard-admin" class="active">🎫 Kelola Pemesanan</a>
<a href="/admin/destinasi">🏠 Kelola Destinasi</a>
<a href="/admin/pengguna">👤 Kelola Pengguna</a>
<a href="/admin/metode-pembayaran">💳 Metode Pembayaran</a>
<a href="/admin/laporan">📊 Laporan</a>
<a href="/">🏡 Ke Beranda</a>
<a href="/logout">🚪 Keluar</a>
</div>

<div class="table-card">

<h4>Kelola Pemesanan</h4>

<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th>KODE</th>
<th>USER</th>
<th>DESTINASI</th>
<th>TANGGAL</th>
<th>JML</th>
<th>TOTAL</th>
<th>PEMBAYARAN</th>
<th>BUKTI</th>
<th>STATUS</th>
<th>AKSI</th>
</tr>
</thead>
<tbody>

@forelse($bookings as $b)
<tr>
<td>{{ $b->kode_booking }}</td>
<td>{{ $b->user->name ?? '-' }}</td>
<td>{{ $b->destinasi }}</td>
<td>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</td>
<td>{{ $b->jumlah }}</td>
<td>Rp {{ number_format($b->total, 0, ',', '.') }}</td>
<td>{{ $b->metode ?? '-' }}</td>
<td>
@if($b->bukti)
<button type="button" class="btn-sm-custom btn-view"
    onclick="lihatBukti('{{ asset('storage/'.$b->bukti) }}')">
    👁 Lihat
</button>
@else
-
@endif
</td>
<td>
@if($b->status == 'dikonfirmasi')
<span class="status-confirm">✔ Dikonfirmasi</span>
@elseif($b->status == 'ditolak')
<span class="status-cancel">✕ Ditolak</span>
@elseif($b->status == 'dibatalkan')
<span class="status-cancel">✕ Dibatalkan</span>
@elseif($b->status == 'refund')
<span class="status-cancel">↩ Refund</span>
@if(($b->nominal_kurang ?? 0) > 0)
<span class="info-kurang">Menunggu bayar ulang Rp {{ number_format($b->nominal_kurang, 0, ',', '.') }}</span>
@else
<span class="info-kurang">Tidak perlu bayar ulang</span>
@endif
@else
<span class="status-wait">⌛ Menunggu</span>
@endif
</td>
<td>
<div class="d-flex gap-1 flex-wrap">

@if($b->status == 'menunggu')

    <form action="/admin/booking/{{ $b->id }}/konfirmasi" method="POST" onsubmit="return confirm('Konfirmasi pemesanan ini? E-tiket akan otomatis tersedia untuk pengguna.')">
    @csrf
    <button class="btn-sm-custom btn-confirm">✔ Konfirmasi</button>
    </form>

    <form action="/admin/booking/{{ $b->id }}/tolak" method="POST" onsubmit="return confirm('Tolak pemesanan ini?')">
    @csrf
    <button class="btn-sm-custom btn-reject">✕ Tolak</button>
    </form>

    <button type="button" class="btn-sm-custom btn-refund"
        onclick="bukaRefund({{ $b->id }}, '{{ $b->kode_booking }}')">
        ↩ Refund
    </button>

@elseif($b->status == 'dikonfirmasi')

    <a href="/tiket/{{ $b->id }}" target="_blank" class="btn-sm-custom btn-ticket">🎫 Tiket</a>

    <button type="button" class="btn-sm-custom btn-refund"
        onclick="bukaRefund({{ $b->id }}, '{{ $b->kode_booking }}')">
        ↩ Refund
    </button>

@endif

<form action="/admin/booking/{{ $b->id }}/hapus" method="POST" onsubmit="return confirm('Yakin hapus data pemesanan ini? Data tidak bisa dikembalikan.')">
@csrf
@method('DELETE')
<button class="btn-sm-custom btn-delete">🗑</button>
</form>

</div>
</td>
</tr>
@empty
<tr>
<td colspan="10" class="text-center text-muted py-4">Belum ada pemesanan.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>

</div>

<!-- MODAL: LIHAT BUKTI PEMBAYARAN -->

<div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">📄 Bukti Pembayaran</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<img id="gambarBukti" src="" alt="Bukti Pembayaran">
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>

</div>
</div>
</div>

<!-- MODAL: PROSES REFUND -->

<div class="modal fade" id="modalRefund" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="formRefund" method="POST">
@csrf

<div class="modal-header">
<h5 class="modal-title">💸 Refund Pemesanan</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<label class="form-label fw-bold">Kode Booking</label>
<input type="text" id="kodeBookingRefund" class="form-control mb-3" readonly>

<label class="form-label fw-bold">Nominal Kurang Bayar (Rp)</label>
<input type="number" name="nominal_kurang" class="form-control mb-1" placeholder="Contoh: 50000 (isi jika user harus menambah pembayaran)">
<small class="text-muted d-block mb-3">Kosongkan / isi 0 jika tidak ada kekurangan pembayaran.</small>

<label class="form-label fw-bold">Catatan / Alasan Refund *</label>
<textarea name="catatan_refund" class="form-control" rows="3" placeholder="Jelaskan alasan refund kepada pengguna..." required></textarea>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
<button type="submit" class="btn" style="background:#ef4444;color:white;">Proses Refund</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function lihatBukti(url){
    document.getElementById('gambarBukti').src = url;
    new bootstrap.Modal(document.getElementById('modalBukti')).show();
}

function bukaRefund(id, kodeBooking){
    document.getElementById('kodeBookingRefund').value = kodeBooking;
    document.getElementById('formRefund').action = '/admin/booking/' + id + '/refund';
    new bootstrap.Modal(document.getElementById('modalRefund')).show();
}

</script>

</body>
</html>