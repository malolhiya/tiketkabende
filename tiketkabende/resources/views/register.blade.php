<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Daftar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(90deg,#18b3aa,#d67641);
}

.register-card{
width:450px;
background:white;
border-radius:25px;
padding:35px;
box-shadow:0 10px 30px rgba(0,0,0,.2);
}

.back-btn{
position:absolute;
top:20px;
left:20px;
background:rgba(255,255,255,.2);
color:white;
padding:10px 18px;
border-radius:30px;
text-decoration:none;
font-weight:600;
}

.logo{
text-align:center;
}

.logo img{
width:70px;
height:70px;
}

.logo h2{
font-weight:700;
margin-top:10px;
}

.logo p{
color:#666;
}

.line{
width:45px;
height:3px;
background:#0f9388;
margin:15px auto 25px;
border-radius:10px;
}

.form-control{
height:50px;
border-radius:12px;
}

.btn-register{
width:100%;
height:50px;
border:none;
border-radius:10px;
background:#0f9388;
color:white;
font-weight:600;
margin-top:15px;
}

.footer-text{
text-align:center;
margin-top:20px;
}

.footer-text a{
text-decoration:none;
color:#0f9388;
font-weight:600;
}

</style>
</head>
<body>

<a href="/" class="back-btn">← Kembali</a>

<div class="register-card">

<div class="logo">

<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">

<h2>Daftar Akun</h2>

<p>Mulai perjalanan wisata Anda di Kabupaten Ende</p>

<div class="line"></div>
@if ($errors->any())
<div class="alert alert-danger">

@foreach ($errors->all() as $error)

<div>{{ $error }}</div>

@endforeach

</div>
@endif

</div>


    <form action="/register" method="POST">
    @csrf
    
    

<div class="mb-3">
<label>Nama Lengkap</label>
<input type="text"
       name="name"
       class="form-control"
       placeholder="Masukkan nama lengkap">
<div class="mb-3">
<label>Email</label>
<input type="email"
       name="email"
       class="form-control"
       placeholder="nama@email.com">
<div class="mb-3">
<label>No. Telepon</label>
<input type="text"
       name="phone"
       class="form-control"
       placeholder="08xxxxxxxxxx">

<div class="mb-3">
<label>Password</label>
<input type="password"
       name="password"
       class="form-control"
       placeholder="Masukkan password">

<button type="submit" class="btn-register">
Daftar Sekarang
</button>

<div class="footer-text">
Sudah punya akun?
<a href="/login">Masuk di sini</a>
</div>

</form>

</div>

</body>
</html>