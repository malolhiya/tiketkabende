<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lupa Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f8fafc;
}

.card-box{
width:500px;
background:white;
padding:40px;
border-radius:25px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.btn-custom{
background:#0f9388;
color:white;
border:none;
padding:12px 25px;
border-radius:10px;
}

</style>

</head>
<body>

<div class="card-box">

<h1>
🔑 Lupa Password
</h1>

<p>
Masukkan email akun Anda, lalu buat password baru.
</p>

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

<form action="/forgot-password" method="POST">

@csrf

<label>Email Terdaftar</label>

<input type="email"
name="email"
class="form-control mt-2 mb-4"
placeholder="nama@email.com"
required>

<div class="d-flex justify-content-end gap-3">

<a href="/login"
class="btn btn-light">
Batal
</a>

<button class="btn-custom">
Cari Akun
</button>

</div>

</form>

</div>

</body>
</html>