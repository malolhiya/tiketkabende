<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\Booking;
use App\Models\User;
use App\Models\Destinasi;
use App\Models\MetodePembayaran;

Route::get('/', function () {
    return view('landing');
});

Route::get('/destinasi', function () {
    $destinasiList = Destinasi::orderBy('id')->get();
    return view('destinasi', compact('destinasiList'));
});

Route::get('/register', [AuthController::class,'register']);
Route::post('/register', [AuthController::class,'registerProcess']);

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'loginProcess']);

Route::get('/dashboard', function () {
    $destinasiList = Destinasi::orderBy('id')->get();
    return view('dashboard', compact('destinasiList'));
})->middleware('auth');

Route::get('/logout', [AuthController::class,'logout']);

Route::get('/forgot-password', function () {
    return view('forgot-password');
});
Route::post('/forgot-password', [AuthController::class, 'cekEmail']);
Route::post('/reset-password', [AuthController::class, 'simpanPasswordBaru']);

// ===== HALAMAN BOOKING =====

Route::get('/booking', function () {
    $destinasiList = Destinasi::orderBy('id')->get();
    return view('booking', compact('destinasiList'));
})->middleware('auth');

Route::post('/booking', function (Request $request) {
    session([
        'destinasi' => $request->destinasi,
        'tanggal'   => $request->tanggal,
        'jumlah'    => $request->jumlah,
        'total'     => $request->total,
    ]);

    return redirect('/payment');
})->middleware('auth');

// ===== HALAMAN PEMBAYARAN =====

Route::get('/payment', function () {
    $metodeList = MetodePembayaran::where('aktif', true)->orderBy('id')->get();
    return view('payment', compact('metodeList'));
})->middleware('auth');

Route::post('/payment', function (Request $request) {

    $buktiPath = null;
    if ($request->hasFile('bukti')) {
        $buktiPath = $request->file('bukti')->store('bukti-pembayaran', 'public');
    }

    $booking = Booking::create([
        'user_id'      => auth()->id(),
        'kode_booking' => 'ENDE'.rand(1000000,9999999),
        'destinasi'    => session('destinasi'),
        'tanggal'      => session('tanggal'),
        'jumlah'       => session('jumlah'),
        'total'        => session('total'),
        'metode'       => $request->metode,
        'bukti'        => $buktiPath,
        'status'       => 'menunggu',
    ]);

    session(['kode_booking_terakhir' => $booking->kode_booking]);

    return redirect('/success');
})->middleware('auth');

// ===== HALAMAN SUKSES =====

Route::get('/success', function () {
    $booking = Booking::where('kode_booking', session('kode_booking_terakhir'))->first();
    return view('success', compact('booking'));
})->middleware('auth');

// ===== DASHBOARD USER =====

Route::get('/dashboard-user', function () {
    $bookings = Booking::where('user_id', auth()->id())->latest()->get();

    $total        = $bookings->count();
    $menunggu     = $bookings->where('status', 'menunggu')->count();
    $dikonfirmasi = $bookings->where('status', 'dikonfirmasi')->count();

    $totalPengeluaran = $bookings
        ->whereIn('status', ['menunggu', 'dikonfirmasi'])
        ->sum('total');

    return view('dashboard-user', compact('bookings', 'total', 'menunggu', 'dikonfirmasi', 'totalPengeluaran'));
})->middleware('auth');

Route::post('/booking/{id}/batal', function ($id) {
    $booking = Booking::where('user_id', auth()->id())->findOrFail($id);
    $booking->update(['status' => 'dibatalkan']);
    return redirect('/dashboard-user')->with('success', 'Pemesanan berhasil dibatalkan.');
})->middleware('auth');

// ===== PEMBAYARAN ULANG =====

Route::get('/bayar-ulang/{id}', function ($id) {
    $booking = Booking::where('user_id', auth()->id())
        ->where('status', 'refund')
        ->findOrFail($id);

    if (($booking->nominal_kurang ?? 0) <= 0) {
        return redirect('/dashboard-user');
    }

    $metodeList = MetodePembayaran::where('aktif', true)->orderBy('id')->get();

    return view('bayar-ulang', compact('booking', 'metodeList'));
})->middleware('auth');

Route::post('/bayar-ulang/{id}', function (Request $request, $id) {

    $booking = Booking::where('user_id', auth()->id())
        ->where('status', 'refund')
        ->findOrFail($id);

    $buktiPath = $booking->bukti;
    if ($request->hasFile('bukti')) {
        $buktiPath = $request->file('bukti')->store('bukti-pembayaran', 'public');
    }

    $booking->update([
        'metode' => $request->metode,
        'bukti'  => $buktiPath,
        'status' => 'menunggu',
    ]);

    return redirect('/dashboard-user')->with('success', 'Pembayaran ulang berhasil dikirim, menunggu konfirmasi admin.');
})->middleware('auth');

// ===== E-TIKET =====

Route::get('/tiket/{id}', function ($id) {
    $booking = Booking::with('user')->findOrFail($id);

    if (auth()->id() !== $booking->user_id && auth()->user()->role !== 'admin') {
        abort(403, 'Anda tidak memiliki akses ke tiket ini.');
    }

    if ($booking->status !== 'dikonfirmasi') {
        abort(403, 'Tiket belum tersedia karena pemesanan belum dikonfirmasi.');
    }

    return view('tiket', compact('booking'));
})->middleware('auth');

// ===== ADMIN =====

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard-admin', function () {
        $bookings = Booking::with('user')->latest()->get();

        $totalPemesanan  = $bookings->count();
        $totalPengguna   = User::where('role', 'user')->count();
        $totalDestinasi  = Destinasi::count();
        $totalPendapatan = $bookings->where('status', 'dikonfirmasi')->sum('total');

        return view('dashboard-admin', compact(
            'bookings', 'totalPemesanan', 'totalPengguna', 'totalDestinasi', 'totalPendapatan'
        ));
    });

    Route::post('/admin/booking/{id}/konfirmasi', function ($id) {
        Booking::findOrFail($id)->update(['status' => 'dikonfirmasi']);
        return redirect('/dashboard-admin')->with('success', 'Pemesanan dikonfirmasi. E-tiket sudah bisa diakses pengguna.');
    });

    Route::post('/admin/booking/{id}/tolak', function ($id) {
        Booking::findOrFail($id)->update(['status' => 'ditolak']);
        return redirect('/dashboard-admin')->with('success', 'Pemesanan ditolak.');
    });

    Route::post('/admin/booking/{id}/refund', function (Request $request, $id) {

        $request->validate([
            'catatan_refund' => 'required|string',
            'nominal_kurang' => 'nullable|integer|min:0',
        ], [
            'catatan_refund.required' => 'Alasan refund wajib diisi.',
        ]);

        Booking::findOrFail($id)->update([
            'status'         => 'refund',
            'catatan_refund' => $request->catatan_refund,
            'nominal_kurang' => $request->nominal_kurang ?: 0,
        ]);

        return redirect('/dashboard-admin')->with('success', 'Pemesanan berhasil direfund. Pengguna dapat melihat catatan Anda dan nominal kurang bayar serta melakukan pembayaran ulang.');
    });

    Route::delete('/admin/booking/{id}/hapus', function ($id) {
        Booking::findOrFail($id)->delete();
        return redirect('/dashboard-admin')->with('success', 'Data pemesanan berhasil dihapus.');
    });

    // ===== VERIFIKASI TIKET (untuk petugas di lokasi wisata, tanpa perlu login) =====

Route::get('/verifikasi', function () {
    return view('verifikasi');
});

Route::get('/verifikasi/{kode}', function ($kode) {
    $booking = Booking::with('user')->where('kode_booking', $kode)->first();
    return view('verifikasi-hasil', compact('booking', 'kode'));
});

Route::post('/verifikasi/{kode}/checkin', function ($kode) {
    $booking = Booking::where('kode_booking', $kode)
        ->where('status', 'dikonfirmasi')
        ->first();

    if ($booking && !$booking->checked_in_at) {
        $booking->update(['checked_in_at' => now()]);
    }

    return redirect('/verifikasi/' . $kode);
});

    // ===== KELOLA DESTINASI =====

    Route::get('/admin/destinasi', function () {
        $bookings = Booking::with('user')->latest()->get();

        $totalPemesanan  = $bookings->count();
        $totalPengguna   = User::where('role', 'user')->count();
        $totalDestinasi  = Destinasi::count();
        $totalPendapatan = $bookings->where('status', 'dikonfirmasi')->sum('total');

        $destinasiList = Destinasi::orderBy('id')->get();

        return view('kelola-destinasi', compact(
            'destinasiList', 'totalPemesanan', 'totalPengguna', 'totalDestinasi', 'totalPendapatan'
        ));
    });

    Route::post('/admin/destinasi', function (Request $request) {
        $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'icon' => 'nullable|string',
            'gambar' => 'nullable|url',
        ]);

        Destinasi::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'icon' => $request->icon ?: '🏔',
            'gambar' => $request->gambar,
        ]);

        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil ditambahkan.');
    });

    Route::put('/admin/destinasi/{id}', function (Request $request, $id) {
        $request->validate([
            'nama' => 'required|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'icon' => 'nullable|string',
            'gambar' => 'nullable|url',
        ]);

        $destinasi = Destinasi::findOrFail($id);
        $destinasi->update([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'icon' => $request->icon ?: '🏔',
            'gambar' => $request->gambar,
        ]);

        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil diperbarui.');
    });

    Route::delete('/admin/destinasi/{id}', function ($id) {
        Destinasi::findOrFail($id)->delete();
        return redirect('/admin/destinasi')->with('success', 'Destinasi berhasil dihapus.');
    });

    // ===== KELOLA PENGGUNA =====

    Route::get('/admin/pengguna', function () {
        $bookings = Booking::with('user')->latest()->get();

        $totalPemesanan  = $bookings->count();
        $totalPengguna   = User::where('role', 'user')->count();
        $totalDestinasi  = Destinasi::count();
        $totalPendapatan = $bookings->where('status', 'dikonfirmasi')->sum('total');

        $penggunaList = User::orderBy('id')->get();

        return view('kelola-pengguna', compact(
            'penggunaList', 'totalPemesanan', 'totalPengguna', 'totalDestinasi', 'totalPendapatan'
        ));
    });

    Route::delete('/admin/pengguna/{id}', function ($id) {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect('/admin/pengguna')->with('error', 'Akun admin tidak dapat dihapus.');
        }

        // Hapus juga semua booking milik user ini supaya tidak jadi data yatim
        Booking::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect('/admin/pengguna')->with('success', 'Pengguna berhasil dihapus.');
    });

    // ===== KELOLA METODE PEMBAYARAN =====

    Route::get('/admin/metode-pembayaran', function () {
        $bookings = Booking::with('user')->latest()->get();

        $totalPemesanan  = $bookings->count();
        $totalPengguna   = User::where('role', 'user')->count();
        $totalDestinasi  = Destinasi::count();
        $totalPendapatan = $bookings->where('status', 'dikonfirmasi')->sum('total');

        $metodeList = MetodePembayaran::orderBy('id')->get();

        return view('kelola-metode-pembayaran', compact(
            'metodeList', 'totalPemesanan', 'totalPengguna', 'totalDestinasi', 'totalPendapatan'
        ));
    });

    Route::post('/admin/metode-pembayaran', function (Request $request) {
        $request->validate([
            'tipe' => 'required|string',
            'nama' => 'required|string',
            'nomor' => 'required|string',
            'atas_nama' => 'required|string',
            'aktif' => 'nullable',
        ]);

        MetodePembayaran::create([
            'tipe' => $request->tipe,
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'atas_nama' => $request->atas_nama,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect('/admin/metode-pembayaran')->with('success', 'Metode pembayaran berhasil ditambahkan.');
    });

    Route::put('/admin/metode-pembayaran/{id}', function (Request $request, $id) {
        $request->validate([
            'tipe' => 'required|string',
            'nama' => 'required|string',
            'nomor' => 'required|string',
            'atas_nama' => 'required|string',
            'aktif' => 'nullable',
        ]);

        $metode = MetodePembayaran::findOrFail($id);
        $metode->update([
            'tipe' => $request->tipe,
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'atas_nama' => $request->atas_nama,
            'aktif' => $request->has('aktif'),
        ]);

        return redirect('/admin/metode-pembayaran')->with('success', 'Metode pembayaran berhasil diperbarui.');
    });

    Route::delete('/admin/metode-pembayaran/{id}', function ($id) {
        MetodePembayaran::findOrFail($id)->delete();
        return redirect('/admin/metode-pembayaran')->with('success', 'Metode pembayaran berhasil dihapus.');
    });

    // ===== LAPORAN =====

    Route::get('/admin/laporan', function () {
        $bookings = Booking::with('user')->latest()->get();

        $totalPemesanan  = $bookings->count();
        $totalPengguna   = User::where('role', 'user')->count();
        $totalDestinasi  = Destinasi::count();
        $totalPendapatan = $bookings->where('status', 'dikonfirmasi')->sum('total');

        $hariIni  = \Carbon\Carbon::today();
        $bulanIni = \Carbon\Carbon::now()->month;
        $tahunIni = \Carbon\Carbon::now()->year;

        $penjualanHariIni = Booking::where('status', 'dikonfirmasi')
            ->whereDate('created_at', $hariIni)
            ->sum('total');

        $penjualanBulanIni = Booking::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total');

        $totalTransaksi = $bookings->count();

        return view('laporan', compact(
            'bookings',
            'totalPemesanan', 'totalPengguna', 'totalDestinasi', 'totalPendapatan',
            'penjualanHariIni', 'penjualanBulanIni', 'totalTransaksi'
        ));
    });

    // Halaman versi cetak (dibuka di tab baru, siap langsung di-print)
    Route::get('/admin/laporan/print', function () {
        $bookings = Booking::with('user')->latest()->get();

        $hariIni  = \Carbon\Carbon::today();
        $bulanIni = \Carbon\Carbon::now()->month;
        $tahunIni = \Carbon\Carbon::now()->year;

        $penjualanHariIni = Booking::where('status', 'dikonfirmasi')
            ->whereDate('created_at', $hariIni)
            ->sum('total');

        $penjualanBulanIni = Booking::where('status', 'dikonfirmasi')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('total');

        $totalTransaksi = $bookings->count();

        return view('laporan-print', compact('bookings', 'penjualanHariIni', 'penjualanBulanIni', 'totalTransaksi'));
    });

    // Export CSV asli
    Route::get('/admin/laporan/export-csv', function () {
        $bookings = Booking::with('user')->latest()->get();

        $filename = 'laporan-penjualan-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Tanggal', 'Kode Booking', 'Nama', 'Destinasi', 'Jumlah', 'Total', 'Status']);

            foreach ($bookings as $b) {
                fputcsv($file, [
                    \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y'),
                    $b->kode_booking,
                    $b->user->name ?? '-',
                    $b->destinasi,
                    $b->jumlah,
                    $b->total,
                    ucfirst($b->status),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    });

    // Export Excel (format .xls sederhana berbasis tabel HTML, langsung bisa dibuka
    // di Excel tanpa perlu library tambahan seperti maatwebsite/excel)
    Route::get('/admin/laporan/export-excel', function () {
        $bookings = Booking::with('user')->latest()->get();

        $filename = 'laporan-penjualan-' . now()->format('Y-m-d') . '.xls';

        $html  = '<table border="1">';
        $html .= '<tr><th>Tanggal</th><th>Kode Booking</th><th>Nama</th><th>Destinasi</th><th>Jumlah</th><th>Total</th><th>Status</th></tr>';

        foreach ($bookings as $b) {
            $html .= '<tr>';
            $html .= '<td>' . \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') . '</td>';
            $html .= '<td>' . $b->kode_booking . '</td>';
            $html .= '<td>' . ($b->user->name ?? '-') . '</td>';
            $html .= '<td>' . $b->destinasi . '</td>';
            $html .= '<td>' . $b->jumlah . '</td>';
            $html .= '<td>' . $b->total . '</td>';
            $html .= '<td>' . ucfirst($b->status) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response($html, 200, $headers);
    });

});