<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cetak Laporan Penjualan</title>

<style>

*{ box-sizing:border-box; }

body{
    font-family:'Segoe UI',Arial,sans-serif;
    color:#222;
    padding:30px 40px;
    margin:0;
}

.header h1{
    font-size:22px;
    font-weight:700;
    margin:0 0 4px;
    display:flex;
    align-items:center;
    gap:8px;
}

.header p{
    margin:0 0 20px;
    color:#666;
    font-size:13.5px;
}

.ringkasan{
    display:flex;
    gap:16px;
    margin-bottom:24px;
}

.ringkasan .box{
    background:#f4f6f8;
    border-radius:10px;
    padding:14px 18px;
    flex:1;
}

.ringkasan .box .label{
    color:#666;
    font-size:12.5px;
    margin-bottom:4px;
}

.ringkasan .box .value{
    font-size:20px;
    font-weight:700;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

thead tr{
    background:#0f9388;
    color:white;
}

thead th{
    text-align:left;
    padding:10px 14px;
    font-size:13px;
    font-weight:600;
}

tbody td{
    padding:10px 14px;
    border-bottom:1px solid #eee;
    font-size:13.5px;
}

tbody tr:nth-child(even){
    background:#fafbfc;
}

.status{
    font-size:12.5px;
}

.no-print{
    margin-bottom:20px;
}

.btn-print-now{
    background:#0f9388;
    color:white;
    border:none;
    padding:10px 22px;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
    font-size:14px;
}

@media print{
    .no-print{ display:none; }
    body{ padding:0 20px; }
}

</style>
</head>
<body>

<div class="no-print">
<button class="btn-print-now" onclick="window.print()">🖨 Cetak Sekarang</button>
</div>

<div class="header">
<h1>📊 Laporan Penjualan</h1>
<p>Wisata Kabupaten Ende - NTT&nbsp;&nbsp;|&nbsp;&nbsp;Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
</div>

<div class="ringkasan">
<div class="box">
<div class="label">Penjualan Hari Ini</div>
<div class="value">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</div>
</div>
<div class="box">
<div class="label">Penjualan Bulan Ini</div>
<div class="value">Rp {{ number_format($penjualanBulanIni, 0, ',', '.') }}</div>
</div>
<div class="box">
<div class="label">Total Transaksi</div>
<div class="value">{{ $totalTransaksi }}</div>
</div>
</div>

<table>
<thead>
<tr>
<th>Tanggal</th>
<th>Kode Booking</th>
<th>Destinasi</th>
<th>Jumlah</th>
<th>Total</th>
<th>Status</th>
</tr>
</thead>
<tbody>

@forelse($bookings as $b)
<tr>
<td>{{ \Carbon\Carbon::parse($b->tanggal)->format('j/n/Y') }}</td>
<td><b>{{ $b->kode_booking }}</b></td>
<td>{{ $b->destinasi }}</td>
<td>{{ $b->jumlah }} tiket</td>
<td>Rp {{ number_format($b->total, 0, ',', '.') }}</td>
<td class="status">
@if($b->status == 'dikonfirmasi')
✔ Dikonfirmasi
@elseif($b->status == 'menunggu')
⏳ Menunggu
@elseif($b->status == 'refund')
↩ Direfund
@else
✕ {{ ucfirst($b->status) }}
@endif
</td>
</tr>
@empty
<tr>
<td colspan="6" style="text-align:center;color:#888;padding:20px;">Belum ada transaksi.</td>
</tr>
@endforelse

</tbody>
</table>

</body>
</html>