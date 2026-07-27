<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pemesanan Tiket</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f5f7fa;font-family:'Segoe UI',sans-serif;}
.booking-box{max-width:900px;margin:40px auto;background:white;padding:30px;border-radius:20px;box-shadow:0 5px 20px rgba(0,0,0,.1);}
.title{font-size:30px;font-weight:bold;margin-bottom:25px;text-align:center;color:#0f9388;}
.summary{background:#f8fafc;padding:20px;border-radius:15px;border:1px solid #ddd;}
.summary img{width:100%;height:180px;object-fit:cover;border-radius:10px;}
.price{font-size:28px;font-weight:bold;color:#0f9388;}
.btn-payment{width:100%;background:#0f9388;color:white;border:none;padding:12px;border-radius:10px;font-weight:bold;}
.btn-payment:hover{background:#0c7d73;}
.error-text{color:#dc3545;font-size:13px;margin-top:-10px;margin-bottom:12px;display:none;}
.is-invalid{border-color:#dc3545 !important;}
.summary-lokasi{color:#666;font-size:14px;margin-top:8px;}
.link-maps{display:inline-block;font-size:13px;font-weight:600;color:#0f9388;text-decoration:none;margin-top:10px;border:1px solid #0f9388;padding:4px 10px;border-radius:6px;}
.link-maps:hover{background:#0f9388;color:white;}
</style>
</head>
<body>

<div class="container">
<div class="booking-box">

<div class="title">🎫 Pesan Tiket Wisata</div>

<form action="/booking" method="POST" id="formBooking" novalidate>
@csrf

<div class="row">
<div class="col-md-6">

<label>Destinasi Wisata</label>
<select name="destinasi" id="destinasi" class="form-control mb-3" onchange="updateSummary()">
@foreach($destinasiList as $d)
<option data-nama="{{ $d->nama }}">{{ $d->nama }} - Rp{{ number_format($d->harga, 0, ',', '.') }}</option>
@endforeach
</select>

<label>Tanggal Kunjungan</label>
<input type="date" name="tanggal" id="tanggal" class="form-control mb-1" onchange="updateSummary()">
<div class="error-text" id="errorTanggal">Tanggal kunjungan wajib diisi.</div>

<label>Jumlah Tiket</label>
<input type="text"
       inputmode="numeric"
       name="jumlah"
       id="jumlah"
       class="form-control mb-1"
       value="1"
       autocomplete="off">
<div class="error-text" id="errorJumlah">Jumlah tiket wajib diisi dan harus berupa angka bulat (1, 2, 3, dst), tanpa koma atau titik.</div>

</div>

<div class="col-md-6">
<div class="summary">

<h5>Ringkasan Pemesanan</h5>
<img id="gambarSummary" src="" alt="">

<h4 class="mt-3" id="destinasiSummary">-</h4>

<div class="summary-lokasi">
📍 <span id="lokasiSummary">-</span>
</div>

<div>
<a href="#" id="linkBukaMaps" target="_blank" class="link-maps">🔗 Buka di Maps</a>
</div>

<iframe id="petaSummary" src="" width="100%" height="200" style="border:0;border-radius:10px;margin-top:10px;" allowfullscreen loading="lazy"></iframe>

<hr>
<p>Tanggal Kunjungan : <b id="tanggalSummary">-</b></p>
<p>Jumlah Tiket : <b id="jumlahSummary">1 Orang</b></p>
<hr>
<div class="price" id="hargaSummary">Rp 0</div>

</div>
</div>
</div>

<input type="hidden" name="total" id="total">

<div class="mt-4">
<button type="submit" class="btn-payment d-block text-center">
Lanjut ke Pembayaran
</button>
</div>

</form>

</div>
</div>

@php
    // Susun data destinasi jadi array asosiatif di PHP dulu,
    // supaya tidak perlu ekspresi kompleks langsung di dalam @json() Blade.
    $destinasiJs = [];
    foreach ($destinasiList as $d) {
        $destinasiJs[$d->nama] = [
            'harga'  => $d->harga,
            'lokasi' => $d->lokasi,
            'peta'   => $d->nama . ' ' . $d->lokasi,
            'gambar' => $d->gambar,
        ];
    }
@endphp

<script>

// Data destinasi diambil LANGSUNG dari database (tabel destinasi), bukan hardcode lagi.
// Setiap kali admin ubah/tambah/hapus destinasi lewat Kelola Destinasi, data ini otomatis ikut berubah.
const destinasiData = {!! json_encode($destinasiJs) !!};

const inputJumlah = document.getElementById('jumlah');
const inputTanggal = document.getElementById('tanggal');
const selectDestinasi = document.getElementById('destinasi');

// Cegah user mengetik koma, titik, huruf, minus, dll — hanya angka 0-9
inputJumlah.addEventListener('input', function(){
    this.value = this.value.replace(/[^0-9]/g, '');
    updateSummary();
});

function updateSummary(){

    let opt = selectDestinasi.options[selectDestinasi.selectedIndex];
    if(!opt) return;

    let nama = opt.getAttribute('data-nama');
    let data = destinasiData[nama];
    if(!data) return;

    let jumlahRaw = inputJumlah.value;
    let jumlah = parseInt(jumlahRaw) || 0;
    let tanggal = inputTanggal.value;
    let total = jumlah * data.harga;

    document.getElementById('destinasiSummary').innerHTML = nama;
    document.getElementById('lokasiSummary').innerHTML = data.lokasi;
    document.getElementById('gambarSummary').src = data.gambar ?? 'https://placehold.co/800x450?text=Wisata+Ende';

    document.getElementById('petaSummary').src =
        'https://maps.google.com/maps?q=' + encodeURIComponent(data.peta) + '&t=&z=13&ie=UTF8&iwloc=&output=embed';

    document.getElementById('linkBukaMaps').href =
        'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(data.peta);

    document.getElementById('jumlahSummary').innerHTML = jumlah + ' Orang';
    document.getElementById('hargaSummary').innerHTML = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('total').value = total;

    document.getElementById('tanggalSummary').innerHTML = tanggal != '' ? tanggal : '-';
}

document.getElementById('formBooking').addEventListener('submit', function(e){

    let valid = true;

    let tanggal = inputTanggal.value;
    let jumlahRaw = inputJumlah.value.trim();
    let jumlah = parseInt(jumlahRaw);

    // Reset tampilan error
    inputTanggal.classList.remove('is-invalid');
    inputJumlah.classList.remove('is-invalid');
    document.getElementById('errorTanggal').style.display = 'none';
    document.getElementById('errorJumlah').style.display = 'none';

    // Validasi tanggal wajib diisi
    if(tanggal == ''){
        inputTanggal.classList.add('is-invalid');
        document.getElementById('errorTanggal').style.display = 'block';
        valid = false;
    }

    // Validasi jumlah: wajib diisi, harus angka bulat (bukan koma/titik/negatif/nol)
    if(jumlahRaw == '' || isNaN(jumlah) || jumlah <= 0 || jumlahRaw.includes(',') || jumlahRaw.includes('.')){
        inputJumlah.classList.add('is-invalid');
        document.getElementById('errorJumlah').style.display = 'block';
        valid = false;
    }

    if(!valid){
        e.preventDefault();
    }
});

window.onload = function(){

    // Jika datang dari halaman destinasi dengan ?destinasi=NamaDestinasi, otomatis pilih
    const params = new URLSearchParams(window.location.search);
    const destinasiTerpilih = params.get('destinasi');

    if(destinasiTerpilih){
        for(let i = 0; i < selectDestinasi.options.length; i++){
            if(selectDestinasi.options[i].getAttribute('data-nama') === destinasiTerpilih){
                selectDestinasi.selectedIndex = i;
                break;
            }
        }
    }

    updateSummary();
};
</script>

</body>
</html>