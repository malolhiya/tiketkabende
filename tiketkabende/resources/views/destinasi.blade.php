<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Destinasi Wisata Kabupaten Ende</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f8fafc;
    font-family:'Segoe UI',sans-serif;
}

.navbar-custom{
    background:#fff;
    padding:15px 0;
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
    font-size:28px;
    font-weight:700;
}

.hero{
    background:linear-gradient(90deg,#1fb5aa,#d97842);
    color:white;
    text-align:center;
    padding:70px 20px;
}

.hero h1{
    font-size:52px;
    font-weight:700;
}

.hero p{
    margin-top:10px;
    font-size:17px;
}

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
    height:230px;
    object-fit:cover;
}

.destination-content{
    padding:18px;
}

.destination-content h4{
    font-size:24px;
    font-weight:700;
    margin-bottom:10px;
}

.location{
    font-size:14px;
    color:#666;
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
    color:#555;
    margin-top:10px;
    min-height:60px;
}

.price{
    display:inline-block;
    background:#d9fff9;
    color:#0f9388;
    font-size:28px;
    font-weight:700;
    padding:8px 18px;
    border-radius:10px;
    margin-top:10px;
}

.btn-book{
    width:100%;
    margin-top:15px;
    background:#0f9388;
    color:white;
    border:none;
    padding:12px;
    border-radius:8px;
    font-weight:600;
}

.btn-book:hover{
    background:#0d7d74;
}

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

<nav class="navbar-custom">

<div class="container d-flex justify-content-between align-items-center">

<div class="logo">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">
<span>Wisata Ende</span>
</div>

<div>
<a href="/login" class="btn btn-light me-2">Masuk</a>
<a href="/register" class="btn btn-success">Daftar</a>
</div>

</div>

</nav>

<section class="hero">
<h1>Destinasi Wisata Kabupaten Ende</h1>
<p>Pilih destinasi favorit Anda — login atau daftar saat ingin memesan tiket</p>
</section>

<div class="container py-5">

<div class="row g-4">

@forelse($destinasiList as $d)

<div class="col-lg-4">

<div class="destination-card">

<img class="destination-image" src="{{ $d->gambar ?? 'https://placehold.co/800x450?text=Wisata+Ende' }}">

<div class="destination-content">

<h4>{{ $d->icon }} {{ $d->nama }}</h4>

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

<button class="btn-book" onclick="pesanSekarang()">
🎫 Pesan Sekarang
</button>

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

<!-- MODAL PETA -->

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function bukaPeta(nama, lokasi, query) {
    document.getElementById('modalPetaJudul').innerText = nama;
    document.getElementById('modalPetaIframe').src =
        'https://maps.google.com/maps?q=' + encodeURIComponent(query) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';
    new bootstrap.Modal(document.getElementById('modalPeta')).show();
}

function pesanSekarang() {
    Swal.fire({
        icon: 'warning',
        title: 'Login Diperlukan',
        html: `<p>Silakan login atau daftar terlebih dahulu untuk memesan tiket wisata.</p>`,
        showCancelButton: true,
        confirmButtonText: 'Login',
        cancelButtonText: 'Daftar',
        confirmButtonColor: '#0f9388',
        cancelButtonColor: '#16a34a'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/login";
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = "/register";
        }
    });
}

</script>

</body>
</html>