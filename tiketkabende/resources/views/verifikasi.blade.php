<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verifikasi Tiket - Wisata Ende</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

body{
    background:#f5f7fa;
    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.box{
    max-width:420px;
    width:100%;
    background:white;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
    padding:35px 30px;
    text-align:center;
}

.icon{
    font-size:48px;
    margin-bottom:10px;
}

h4{
    font-weight:700;
    margin-bottom:5px;
}

p.subtitle{
    color:#777;
    font-size:14px;
    margin-bottom:25px;
}

.btn-cek{
    width:100%;
    background:#0f9388;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    font-weight:600;
}

.btn-cek:hover{
    background:#0c7d73;
    color:white;
}

</style>
</head>
<body>

<div class="box">

<div class="icon">🎫</div>
<h4>Verifikasi Tiket</h4>
<p class="subtitle">Masukkan kode booking pengunjung untuk memeriksa keabsahan tiket</p>

<form id="formVerifikasi">
<input type="text" id="kodeBooking" class="form-control mb-3 text-center" placeholder="Contoh: ENDE12345678" style="text-transform:uppercase;" required>
<button type="submit" class="btn-cek">🔍 Cek Tiket</button>
</form>

</div>

<script>
document.getElementById('formVerifikasi').addEventListener('submit', function(e){
    e.preventDefault();
    let kode = document.getElementById('kodeBooking').value.trim().toUpperCase();
    if(kode !== ''){
        window.location.href = '/verifikasi/' + encodeURIComponent(kode);
    }
});
</script>

</body>
</html>