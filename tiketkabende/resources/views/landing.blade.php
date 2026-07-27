<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Wisata Ende</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    padding:0;
    font-family:'Poppins',sans-serif;
}

.hero{
    position:relative;
    height:100vh;
    overflow:hidden;
}

.hero-img{
    width:100%;
    height:100vh;
    object-fit:cover;
}

.overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
    z-index:1;
}

.navbar-custom{
    position:absolute;
    top:15px;
    left:25px;
    right:25px;
    z-index:999;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
    color:white;
    font-size:18px;
    font-weight:bold;
}

.logo img{
    width:50px;
    height:50px;
    border-radius:10px;
    background:white;
    padding:2px;
}

.hero-content{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    text-align:center;
    color:white;
    z-index:999;
}

.hero-content h1{
    font-size:85px;
    font-weight:bold;
}

.hero-content h4{
    letter-spacing:4px;
}

.btn-jelajah{
    background:#16c2b1;
    color:white;
    text-decoration:none;
    padding:12px 35px;
    border-radius:10px;
}

.section-title{
    text-align:center;
    margin-bottom:30px;
}

.section-title h2{
    font-weight:bold;
}

.card img{
    height:220px;
    object-fit:cover;
}

footer{
    background:#0f172a;
    color:white;
    text-align:center;
    padding:20px;
    margin-top:40px;
}

</style>

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar-custom">

    <div class="logo">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">

        <span>Wisata Ende</span>

    </div>

    <a href="/login"
       class="btn btn-outline-light rounded-pill">
        Masuk
    </a>

</nav>

<!-- HERO -->

<section class="hero">

<div id="heroCarousel"
     class="carousel slide carousel-fade"
     data-bs-ride="carousel"
     data-bs-interval="3000">

<div class="carousel-indicators">

<button data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
<button data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
<button data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>

</div>

<div class="carousel-inner">

<div class="carousel-item active">

<img src="https://mawatu.co.id/wp-content/uploads/2024/05/000043-01_wisata-danau-kelimutu_danau-kelimutu_800x450_ccpdm-min-768x432-1.jpeg"
     class="hero-img">

</div>

<div class="carousel-item">

<img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
     class="hero-img">

</div>

<div class="carousel-item">

<img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e"
     class="hero-img">

</div>

</div>

</div>

<div class="overlay"></div>

<div class="hero-content">

<h1>Kabupaten Ende</h1>

<h4>NUSA TENGGARA TIMUR</h4>

<br>

<a href="/destinasi" class="btn-jelajah">
    Jelajahi Sekarang!
</a>

</div>

</section>

<!-- VIDEO -->

<section class="container py-5">

<div class="section-title">

<h2>🎬 Jelajahi Ende Lewat Video</h2>

<p>Sekilas pesona alam dan budaya Kabupaten Ende</p>

</div>

<div class="ratio ratio-16x9">

<iframe
src="https://www.youtube.com/embed/-RNMXpv4pi0"
allowfullscreen>
</iframe>

</div>

</section>

<!-- DESTINASI -->

<section id="destinasi" class="container py-5">

<div class="section-title">

<h2>🌴 Destinasi Wisata Populer</h2>

</div>

<div class="row">

<div class="col-md-4 mb-4">

<div class="card shadow">

<img src="https://mawatu.co.id/wp-content/uploads/2024/05/000043-01_wisata-danau-kelimutu_danau-kelimutu_800x450_ccpdm-min-768x432-1.jpeg">

<div class="card-body">

<h5>Danau Kelimutu</h5>

<p>Danau tiga warna yang menjadi ikon wisata Kabupaten Ende.</p>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow">

<img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e">

<div class="card-body">

<h5>Pantai Wisata</h5>

<p>Keindahan pantai dengan panorama laut yang memukau.</p>

</div>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="card shadow">

<img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e">

<div class="card-body">

<h5>Wisata Alam</h5>

<p>Pesona alam Kabupaten Ende yang masih asri.</p>

</div>

</div>

</div>

</div>

</section>

<!-- PETA -->

<section class="container py-5">

<div class="section-title">

<h2>📍 Peta Kabupaten Ende</h2>

</div>

<div class="row">

<div class="col-md-7">

<iframe
src="https://www.google.com/maps?q=Kabupaten+Ende&output=embed"
width="100%"
height="400"
style="border:0;">
</iframe>

</div>

<div class="col-md-5">

<div class="card shadow p-4">

<h4>Kantor Dinas Pariwisata Kabupaten Ende</h4>

<hr>

<p>📍 Jalan Soekarno No. 4, Kota Ende</p>

<p>☎ (0381) 21303</p>

<p>📧 pariwisata@endekab.go.id</p>

</div>

</div>

</div>

</section>

<footer>

© 2026 Sistem Informasi E-Ticketing Wisata Kabupaten Ende

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>