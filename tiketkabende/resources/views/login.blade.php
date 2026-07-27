<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login E-Ticketing</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#14b8a6,#ea7a3d);
    font-family:'Segoe UI',sans-serif;
}

.login-card{
    width:500px;
    background:white;
    border-radius:20px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.logo{
    text-align:center;
}

.logo img{
    width:80px;
    height:80px;
}

.logo h2{
    margin-top:10px;
    font-weight:bold;
}

.logo p{
    color:#666;
}

.line{
    width:60px;
    height:4px;
    background:#14b8a6;
    margin:15px auto 25px;
    border-radius:10px;
}

.role-card{
    border:2px solid #ddd;
    border-radius:15px;
    padding:20px;
    text-align:center;
    cursor:pointer;
}

.role-card.active{
    border-color:#14b8a6;
    background:#e8fffb;
}

.role-icon{
    font-size:40px;
}

.btn-login{
    width:100%;
    background:#14b8a6;
    color:white;
    font-weight:bold;
    padding:12px;
    border:none;
    border-radius:10px;
}

.btn-login:hover{
    background:#0f9388;
}

</style>
</head>

<body>

<div class="login-card">

<div class="logo">

<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1c_E3o2mNI63fOORanb2gShc7hWj5Dx_dgp3KrH8UvQ&s">

<h2>Selamat Datang</h2>

<p>Masuk ke akun E-Ticketing Kabupaten Ende</p>

<div class="line"></div>

</div>

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="/login" method="POST">

@csrf

<div class="mb-3">
<label>Email</label>
<input type="email"
name="email"
class="form-control"
placeholder="Masukkan Email"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>
</div>

<div class="text-end mb-3">

<a href="/forgot-password">
    Lupa Password?
</a>

</div>

<div class="mb-3">

<label class="fw-bold mb-2">

Login Sebagai

</label>

<div class="row">

<div class="col-6">

<div class="role-card active"
onclick="pilihRole(this,'user')">

<div class="role-icon">👤</div>

<h5>User</h5>

<small>Wisatawan</small>

</div>

</div>

<div class="col-6">

<div class="role-card"
onclick="pilihRole(this,'admin')">

<div class="role-icon">🛠️</div>

<h5>Admin</h5>

<small>Pengelola</small>

</div>

</div>

</div>

<input type="hidden"
name="role"
id="role"
value="user">

</div>

<button type="submit" class="btn-login">

Masuk

</button>

<div class="text-center mt-3">

Belum punya akun?

<a href="/register">

Daftar sekarang

</a>

</div>

</form>

</div>

<script>

function pilihRole(element, role){

document.getElementById('role').value = role;

document.querySelectorAll('.role-card').forEach(card => {
card.classList.remove('active');
});

element.classList.add('active');

}

</script>

</body>
</html>