<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelola Pengguna - Admin</title>
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

.badge-admin{
    background:#d9f5e3;
    color:#15803d;
    padding:4px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-user{
    background:#fdecd2;
    color:#b45309;
    padding:4px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.btn-sm-custom{
    border:none; padding:6px 14px; border-radius:8px; font-size:12px;
    color:white; font-weight:600;
}

.btn-delete{ background:#ef4444; }

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

@if(session('error'))
<script>
    window.addEventListener('DOMContentLoaded', function(){
        alert(@json(session('error')));
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
<a href="/admin/pengguna" class="active">👤 Kelola Pengguna</a>
<a href="/admin/metode-pembayaran">💳 Metode Pembayaran</a>
<a href="/admin/laporan">📊 Laporan</a>
<a href="/">🏡 Ke Beranda</a>
<a href="/logout">🚪 Keluar</a>
</div>

<div class="table-card">

<h4>Kelola Pengguna</h4>

<div class="table-responsive">
<table class="table align-middle">
<thead>
<tr>
<th>ID</th>
<th>NAMA</th>
<th>EMAIL</th>
<th>TELEPON</th>
<th>ROLE</th>
<th>AKSI</th>
</tr>
</thead>
<tbody>

@forelse($penggunaList as $u)
<tr>
<td>{{ $u->id }}</td>
<td>{{ $u->name }}</td>
<td>{{ $u->email }}</td>
<td>{{ $u->phone ?? '-' }}</td>
<td>
@if($u->role === 'admin')
<span class="badge-admin">admin</span>
@else
<span class="badge-user">user</span>
@endif
</td>
<td>
@if($u->role === 'admin')
-
@else
<form action="/admin/pengguna/{{ $u->id }}" method="POST" onsubmit="return confirm('Yakin hapus pengguna ini? Semua data pemesanan miliknya juga akan terhapus.')">
@csrf
@method('DELETE')
<button class="btn-sm-custom btn-delete">🗑 Hapus</button>
</form>
@endif
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center text-muted py-4">Belum ada pengguna terdaftar.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>

</div>

</body>
</html>