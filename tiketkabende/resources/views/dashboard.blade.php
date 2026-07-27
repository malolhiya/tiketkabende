<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard User - Wisata Ende</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f8fafc;
    font-family:'Segoe UI',sans-serif;
}

/* Navbar */

.navbar-custom{
    background:#fff;
    padding:12px 0;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
}

.logo img{
    width:35px;
    height:35px;
}

.logo span{
    color:#0f9388;
    font-size:26px;
    font-weight:700;
}

.nav-link{
    color:#444 !important;
    font-weight:600;
    margin:0 10px;
}

.nav-link:hover{
    color:#0f9388 !important;
}

.user-box{
    display:flex;
    align-items:center;
    gap:10px;
}

.user-circle{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#0f9388;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:bold;
}

.btn-logout{
    background:#ef4444;
    color:white;
    border:none;
    padding:6px 14px;
    border-radius:8px;
    text-decoration:none;
}

/* Judul */

.section-title{
    text-align:center;
    margin-top:40px;
    margin-bottom:40px;
}

.section-title h2{
    font-weight:700;
}

.section-title p{
    color:#666;
}

/* Card */

.destination-card{
    background:white;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;
}

.destination-card:hover{
    transform:translateY(-5px);
}

.destination-image{
    width:100%;
    height:220px;
    object-fit:cover;
}

.destination-content{
    padding:18px;
}

.destination-content h5{
    font-weight:700;
}

.location{
    color:#666;
    font-size:14px;
}

.location a{
    color:#0f9388;
    text-decoration:none;
    font-weight:600;
    cursor:pointer;
}

.location a:hover{
    text-decoration:underline;
}

.desc{
    color:#666;
    font-size:14px;
    min-height:60px;
    margin-top:10px;
}

.price{
    background:#d9fff9;
    color:#0f9388;
    display:inline-block;
    padding:8px 15px;
    border-radius:8px;
    font-weight:700;
    font-size:22px;
}

.btn-book{
    width:100%;
    border:none;
    background:#0f9388;
    color:white;
    padding:10px;
    border-radius:8px;
    margin-top:15px;
}

.btn-book:hover{
    background:#0c7d73;
}

/* MODAL PETA */

#modalPeta .modal-content{
    border-radius:16px;
    border:none;
}

#modalPeta .modal-header{
    border-bottom:none;
    padding-bottom:0;
}

#modalPeta .modal-title{
    font-weight:700;
    font-size:20px;
}

#modalPeta .modal-body iframe{
    width:100%;
    height:320px;
    border:0;
    border-radius:10px;
}

</style>
</head>
<body>
    @if(session('success'))
<div class="container mt-3">

<div class="alert alert-success">
{{ session('success') }}
</div>

</div>
@endif

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-custom">

<div class="container">

<a class="navbar-brand logo">

<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">

<span>Wisata Ende</span>

</a>

<ul class="navbar-nav mx-auto">

<li class="nav-item">
<a class="nav-link" href="/">Beranda</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="/dashboard">Destinasi</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/dashboard-user">Dashboard</a>
</li>

</ul>

<div class="user-box">

<div class="user-circle">
{{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>
<span>
{{ Auth::user()->name }}
</span>

<a href="/logout" class="btn-logout">
Keluar
</a>

</div>

</div>

</nav>

<!-- JUDUL -->

<div class="container">

<div class="section-title">

<h2>Destinasi Wisata Populer</h2>

<p>
Pilih destinasi favorit Anda dan mulai petualangan
</p>

</div>

<!-- DESTINASI -->

<div class="row g-4">

@forelse($destinasiList as $d)

<div class="col-lg-4">
<div class="destination-card">

<img class="destination-image" src="{{ $d->gambar ?? 'https://placehold.co/800x450?text=Wisata+Ende' }}">

<div class="destination-content">

<h5>{{ $d->icon }} {{ $d->nama }}</h5>

<div class="location">
📍 {{ $d->lokasi }}
<a href="javascript:void(0)"
   onclick="bukaPeta('{{ addslashes($d->nama) }}','{{ addslashes($d->lokasi) }}','{{ addslashes($d->nama.' '.$d->lokasi) }}')">
Lihat Peta
</a>
</div>

<div class="desc">
{{ $d->deskripsi }}
</div>

<div class="price">
Rp {{ number_format($d->harga, 0, ',', '.') }}
</div>

<a href="/booking?destinasi={{ urlencode($d->nama) }}" class="btn-book d-block text-center text-decoration-none">
🎫 Pesan Sekarang
</a>

</div>
</div>
</div>

@empty

<div class="col-12 text-center text-muted py-5">
Belum ada destinasi yang tersedia.
</div>

@endforelse

</div>

</div>

<!-- MODAL PETA (dipakai bersama untuk semua destinasi) -->

<div class="modal fade" id="modalPeta" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">📍 <span id="modalPetaJudul">Nama Destinasi</span></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<iframe id="modalPetaIframe" src="" allowfullscreen loading="lazy"></iframe>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function bukaPeta(nama, lokasi, query) {

    document.getElementById('modalPetaJudul').innerText = nama;

    document.getElementById('modalPetaIframe').src =
        'https://maps.google.com/maps?q=' + encodeURIComponent(query) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';

    let modal = new bootstrap.Modal(document.getElementById('modalPeta'));
    modal.show();

}

</script>

</body>
</html>