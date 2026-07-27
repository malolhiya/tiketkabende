<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelola Metode Pembayaran - Admin</title>
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

.table-card h4{ font-family: Georgia, 'Times New Roman', serif; font-weight:700; }

table th{ color:#777; font-size:12px; text-transform:uppercase; border-bottom:2px solid #eee; }

.badge-tipe{
    background:#dbeafe;
    color:#1d4ed8;
    padding:4px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-tipe.ewallet{
    background:#dcfce7;
    color:#15803d;
}

.badge-aktif{
    background:#d9f5e3;
    color:#15803d;
    padding:4px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-nonaktif{
    background:#fee2e2;
    color:#dc2626;
    padding:4px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.btn-sm-custom{
    border:none; padding:6px 14px; border-radius:8px; font-size:12px;
    color:white; font-weight:600;
}

.btn-edit{ background:#f59e0b; }
.btn-delete{ background:#ef4444; }
.btn-add{ background:#0f9388; color:white; border:none; padding:10px 20px; border-radius:10px; font-weight:600; }

#modalMetode .modal-content{ border-radius:16px; border:none; }

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
<a href="/dashboard-admin">🎫 Kelola Pemesanan</a>
<a href="/admin/destinasi">🏠 Kelola Destinasi</a>
<a href="/admin/pengguna">👤 Kelola Pengguna</a>
<a href="/admin/metode-pembayaran" class="active">💳 Metode Pembayaran</a>
<a href="/admin/laporan">📊 Laporan</a>
<a href="/">🏡 Ke Beranda</a>
<a href="/logout">🚪 Keluar</a>
</div>

<div class="table-card">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4 class="mb-0">Kelola Metode Pembayaran</h4>
<button type="button" class="btn-add" onclick="bukaTambah()">+ Tambah Metode</button>
</div>

<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th>ID</th>
<th>TIPE</th>
<th>NAMA</th>
<th>NO. REKENING/HP</th>
<th>ATAS NAMA</th>
<th>STATUS</th>
<th>AKSI</th>
</tr>
</thead>
<tbody>

@forelse($metodeList as $m)
<tr>
<td>{{ $m->id }}</td>
<td>
@if($m->tipe === 'Bank')
<span class="badge-tipe">🏦 Bank</span>
@else
<span class="badge-tipe ewallet">📱 E-Wallet</span>
@endif
</td>
<td><b>{{ $m->nama }}</b></td>
<td>{{ $m->nomor }}</td>
<td>{{ $m->atas_nama }}</td>
<td>
@if($m->aktif)
<span class="badge-aktif">✔ Aktif</span>
@else
<span class="badge-nonaktif">✕ Nonaktif</span>
@endif
</td>
<td>
<div class="d-flex gap-1">
<button type="button" class="btn-sm-custom btn-edit"
    onclick="bukaEdit({{ $m->id }}, {{ json_encode($m->tipe) }}, {{ json_encode($m->nama) }}, {{ json_encode($m->nomor) }}, {{ json_encode($m->atas_nama) }}, {{ $m->aktif ? 'true' : 'false' }})">
    ✏️ Edit
</button>

<form action="/admin/metode-pembayaran/{{ $m->id }}" method="POST" onsubmit="return confirm('Yakin hapus metode pembayaran ini?')">
@csrf
@method('DELETE')
<button class="btn-sm-custom btn-delete">🗑 Hapus</button>
</form>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="7" class="text-center text-muted py-4">Belum ada metode pembayaran.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>

</div>

<!-- MODAL: TAMBAH / EDIT METODE PEMBAYARAN -->

<div class="modal fade" id="modalMetode" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="formMetode" method="POST">
@csrf
<input type="hidden" name="_method" id="formMethod" value="">

<div class="modal-header">
<h5 class="modal-title" id="modalMetodeTitle">✏️ Edit Metode Pembayaran</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<label class="form-label fw-bold">Tipe Pembayaran</label>
<select name="tipe" id="inputTipe" class="form-select mb-3" required>
<option value="Bank">🏦 Transfer Bank</option>
<option value="E-Wallet">📱 E-Wallet</option>
</select>

<label class="form-label fw-bold">Nama Bank / E-Wallet</label>
<input type="text" name="nama" id="inputNama" class="form-control mb-3" placeholder="Contoh: BRI, GoPay" required>

<label class="form-label fw-bold">Nomor Rekening / No. HP</label>
<input type="text" name="nomor" id="inputNomor" class="form-control mb-3" required>

<label class="form-label fw-bold">Atas Nama</label>
<input type="text" name="atas_nama" id="inputAtasNama" class="form-control mb-3" required>

<label class="form-label fw-bold">Status</label>
<select name="aktif" id="inputAktif" class="form-select">
<option value="1">✔ Aktif</option>
<option value="0">✕ Nonaktif</option>
</select>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
<button type="submit" class="btn" style="background:#0f9388;color:white;">Simpan</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function bukaTambah(){
    document.getElementById('modalMetodeTitle').innerText = '➕ Tambah Metode Pembayaran';
    document.getElementById('formMetode').action = '/admin/metode-pembayaran';
    document.getElementById('formMethod').value = '';

    document.getElementById('inputTipe').value = 'Bank';
    document.getElementById('inputNama').value = '';
    document.getElementById('inputNomor').value = '';
    document.getElementById('inputAtasNama').value = 'Wisata Ende Official';
    document.getElementById('inputAktif').value = '1';

    new bootstrap.Modal(document.getElementById('modalMetode')).show();
}

function bukaEdit(id, tipe, nama, nomor, atasNama, aktif){
    document.getElementById('modalMetodeTitle').innerText = '✏️ Edit Metode Pembayaran';
    document.getElementById('formMetode').action = '/admin/metode-pembayaran/' + id;
    document.getElementById('formMethod').value = 'PUT';

    document.getElementById('inputTipe').value = tipe;
    document.getElementById('inputNama').value = nama;
    document.getElementById('inputNomor').value = nomor;
    document.getElementById('inputAtasNama').value = atasNama;
    document.getElementById('inputAktif').value = aktif ? '1' : '0';

    new bootstrap.Modal(document.getElementById('modalMetode')).show();
}

</script>

</body>
</html>