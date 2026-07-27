<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelola Destinasi - Admin</title>
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

.desc-cell{
    max-width:280px;
    font-size:13px;
    color:#555;
}

.btn-sm-custom{
    border:none; padding:6px 14px; border-radius:8px; font-size:12px;
    color:white; font-weight:600;
}

.btn-edit{ background:#f59e0b; }
.btn-delete{ background:#ef4444; }
.btn-add{ background:#0f9388; color:white; border:none; padding:10px 20px; border-radius:10px; font-weight:600; }

#modalDestinasi .modal-content{ border-radius:16px; border:none; }
#modalDestinasi iframe{ width:100%; height:180px; border:0; border-radius:10px; }

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
<a href="/admin/destinasi" class="active">🏠 Kelola Destinasi</a>
<a href="/admin/pengguna">👤 Kelola Pengguna</a>
<a href="/admin/metode-pembayaran">💳 Metode Pembayaran</a>
<a href="/admin/laporan">📊 Laporan</a>
<a href="/">🏡 Ke Beranda</a>
<a href="/logout">🚪 Keluar</a>
</div>

<div class="table-card">

<div class="d-flex justify-content-between align-items-center mb-3">
<h4 class="mb-0">Kelola Destinasi Wisata</h4>
<button type="button" class="btn-add" onclick="bukaTambah()">+ Tambah Destinasi</button>
</div>

<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th>ID</th>
<th>NAMA</th>
<th>LOKASI</th>
<th>HARGA</th>
<th>DESKRIPSI</th>
<th>AKSI</th>
</tr>
</thead>
<tbody>

@forelse($destinasiList as $d)
<tr>
<td>{{ $d->id }}</td>
<td>{{ $d->icon }} {{ $d->nama }}</td>
<td>{{ $d->lokasi }}</td>
<td style="color:#0f9388;font-weight:700;">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
<td class="desc-cell">{{ $d->deskripsi }}</td>
<td>
<div class="d-flex gap-1">
<button type="button" class="btn-sm-custom btn-edit"
    onclick="bukaEdit({{ $d->id }}, {{ json_encode($d->nama) }}, {{ json_encode($d->lokasi) }}, {{ json_encode($d->deskripsi) }}, {{ $d->harga }}, {{ json_encode($d->icon) }}, {{ json_encode($d->gambar) }})">
    ✏️ Edit
</button>

<form action="/admin/destinasi/{{ $d->id }}" method="POST" onsubmit="return confirm('Yakin hapus destinasi ini? Data tidak bisa dikembalikan.')">
@csrf
@method('DELETE')
<button class="btn-sm-custom btn-delete">🗑 Hapus</button>
</form>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center text-muted py-4">Belum ada destinasi.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>

</div>

<!-- MODAL: TAMBAH / EDIT DESTINASI -->

<div class="modal fade" id="modalDestinasi" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<form id="formDestinasi" method="POST">
@csrf
<input type="hidden" name="_method" id="formMethod" value="">

<div class="modal-header">
<h5 class="modal-title" id="modalDestinasiTitle">✏️ Edit Destinasi</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<label class="form-label fw-bold">Nama Destinasi</label>
<input type="text" name="nama" id="inputNama" class="form-control mb-3" oninput="updatePetaModal()" required>

<label class="form-label fw-bold">Lokasi</label>
<input type="text" name="lokasi" id="inputLokasi" class="form-control mb-2" oninput="updatePetaModal()" required>

<a href="#" id="linkBukaMaps" target="_blank" class="d-inline-block mb-2" style="font-size:13px;">🔗 Buka di Maps</a>

<iframe id="petaModal" src="" class="mb-1" allowfullscreen loading="lazy"></iframe>
<small class="text-muted d-block mb-3">Peta otomatis mengikuti nama & lokasi yang diketik di atas.</small>

<label class="form-label fw-bold">Deskripsi</label>
<textarea name="deskripsi" id="inputDeskripsi" class="form-control mb-3" rows="3" required></textarea>

<label class="form-label fw-bold">Harga Tiket (Rp)</label>
<input type="number" name="harga" id="inputHarga" class="form-control mb-3" min="0" required>

<label class="form-label fw-bold">Icon/Emoji</label>
<input type="text" name="icon" id="inputIcon" class="form-control mb-3" placeholder="Contoh: 🌋">

<label class="form-label fw-bold">URL Foto (Opsional)</label>
<input type="url" name="gambar" id="inputGambar" class="form-control" placeholder="https://...">

</div>

<div class="modal-footer">
<button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
<button type="submit" class="btn" style="background:#0f9388;color:white;">Simpan Destinasi</button>
</div>

</form>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function updatePetaModal(){
    let nama = document.getElementById('inputNama').value;
    let lokasi = document.getElementById('inputLokasi').value;
    let query = (nama + ' ' + lokasi).trim();

    if(query != ''){
        document.getElementById('petaModal').src =
            'https://maps.google.com/maps?q=' + encodeURIComponent(query) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';

        document.getElementById('linkBukaMaps').href =
            'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(query);
    }
}

function bukaTambah(){
    document.getElementById('modalDestinasiTitle').innerText = '➕ Tambah Destinasi';
    document.getElementById('formDestinasi').action = '/admin/destinasi';
    document.getElementById('formMethod').value = '';

    document.getElementById('inputNama').value = '';
    document.getElementById('inputLokasi').value = '';
    document.getElementById('inputDeskripsi').value = '';
    document.getElementById('inputHarga').value = '';
    document.getElementById('inputIcon').value = '';
    document.getElementById('inputGambar').value = '';
    document.getElementById('petaModal').src = '';

    new bootstrap.Modal(document.getElementById('modalDestinasi')).show();
}

function bukaEdit(id, nama, lokasi, deskripsi, harga, icon, gambar){
    document.getElementById('modalDestinasiTitle').innerText = '✏️ Edit Destinasi';
    document.getElementById('formDestinasi').action = '/admin/destinasi/' + id;
    document.getElementById('formMethod').value = 'PUT';

    document.getElementById('inputNama').value = nama;
    document.getElementById('inputLokasi').value = lokasi;
    document.getElementById('inputDeskripsi').value = deskripsi;
    document.getElementById('inputHarga').value = harga;
    document.getElementById('inputIcon').value = icon;
    document.getElementById('inputGambar').value = gambar ?? '';

    updatePetaModal();

    new bootstrap.Modal(document.getElementById('modalDestinasi')).show();
}

</script>

</body>
</html>