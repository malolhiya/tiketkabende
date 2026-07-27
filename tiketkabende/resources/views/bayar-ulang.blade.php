<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pembayaran Ulang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
font-family:'Segoe UI',sans-serif;
}

.container-box{
max-width:800px;
margin:30px auto;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.title{
font-size:24px;
font-weight:bold;
margin-bottom:20px;
}

.summary-box{
background:#f8fafc;
border:1px solid #ddd;
padding:18px;
border-radius:10px;
margin-bottom:20px;
}

.summary-box p{
display:flex;
justify-content:space-between;
margin-bottom:8px;
}

.summary-box b{
color:#0f9388;
}

.alasan-box{
background:#fff7ed;
border:1px solid #fed7aa;
padding:15px;
border-radius:10px;
margin-bottom:20px;
color:#9a3412;
}

.info-box{
background:#eef6ff;
border:1px solid #cde0ff;
padding:15px;
border-radius:10px;
margin-top:15px;
}

.transfer-box{
background:white;
padding:15px;
border-radius:10px;
margin-top:10px;
}

.total{
font-size:28px;
font-weight:bold;
color:#e67e22;
}

.upload-box{
margin-top:20px;
border:2px dashed #ccc;
padding:40px;
text-align:center;
border-radius:10px;
}

.btn-custom{
background:#0f9388;
color:white;
border:none;
padding:10px 20px;
border-radius:8px;
font-weight:bold;
}

.btn-custom:hover{
background:#0c7d73;
}

</style>
</head>
<body>

<div class="container-box">

<div class="title">
🎫 Pesan Tiket Wisata
</div>

<div class="alasan-box">
<b>⚠️ Alasan Refund dari Admin:</b>
<p class="mb-0 mt-1">{{ $booking->catatan_refund }}</p>
</div>

<div class="summary-box">
    <p><span>Kode Booking:</span> <b>{{ $booking->kode_booking }}</b></p>
    <p><span>Destinasi:</span> <b>{{ $booking->destinasi }}</b></p>
    <p><span>Tanggal:</span> <b>{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</b></p>
    <p><span>Jumlah:</span> <b>{{ $booking->jumlah }} Orang</b></p>
</div>

<h5>💳 Pilih Metode Pembayaran</h5>

<form action="/bayar-ulang/{{ $booking->id }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label class="form-label">
Metode Pembayaran
</label>

<select name="metode" class="form-select" id="metode" onchange="showTransfer()" required>

<option value="">-- Pilih Metode --</option>

@foreach($metodeList as $m)
<option value="{{ $m->nama }}">{{ $m->tipe === 'Bank' ? '🏦' : '📱' }} {{ $m->nama }}</option>
@endforeach

</select>

</div>

<div id="transferInfo" style="display:none;">

<div class="info-box">

<h6>📄 Informasi Transfer</h6>

<div class="transfer-box">

<p>
<b>Nama Bank/E-Wallet:</b>
<span id="bankName"></span>
</p>

<p>
<b>Nomor Rekening/HP:</b><br>
<span id="rekening"></span>
</p>

<p>
<b>Atas Nama:</b><br>
<span id="atasNama"></span>
</p>

<hr>

<p>
Jumlah Transfer:
</p>

<div class="total">
Rp {{ number_format($booking->nominal_kurang, 0, ',', '.') }}
</div>

</div>

<div class="alert alert-warning mt-3">
⚠️ Penting! Transfer sesuai nominal kekurangan di atas, lalu upload bukti pembayaran.
</div>

</div>

<div class="upload-box">

<h5>📤 Upload Bukti Pembayaran</h5>

<input type="file"
name="bukti"
class="form-control mt-3"
required>

</div>

</div>

<div class="mt-4 d-flex justify-content-between">

<a href="/dashboard-user"
class="btn btn-secondary">
⬅ Kembali
</a>

<button type="submit"
class="btn-custom">

Konfirmasi Pembayaran Ulang ✔

</button>

</div>

</form>

</div>

@php
    // Sama seperti di payment.blade.php: susun data metode pembayaran jadi array
    // asosiatif di PHP, supaya sekali admin ubah lewat Kelola Metode Pembayaran,
    // otomatis kepakai di sini juga.
    $metodeJs = [];
    foreach ($metodeList as $m) {
        $metodeJs[$m->nama] = [
            'nomor' => $m->nomor,
            'atas_nama' => $m->atas_nama,
        ];
    }
@endphp

<script>

const metodeData = {!! json_encode($metodeJs) !!};

function showTransfer(){

let metode = document.getElementById('metode').value;

let bankName = document.getElementById('bankName');
let rekening = document.getElementById('rekening');
let atasNama = document.getElementById('atasNama');

if(metode == '' || !metodeData[metode]){
    document.getElementById('transferInfo').style.display='none';
    return;
}

document.getElementById('transferInfo').style.display='block';

let data = metodeData[metode];
bankName.innerHTML = metode;
rekening.innerHTML = data.nomor;
atasNama.innerHTML = data.atas_nama;

}

</script>

</body>
</html>