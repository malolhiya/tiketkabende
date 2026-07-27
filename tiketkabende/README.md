# 🎫 Sistem E-Ticketing Wisata Kabupaten Ende

Sistem informasi pemesanan tiket wisata berbasis web untuk objek-objek wisata di Kabupaten Ende, Nusa Tenggara Timur. Aplikasi ini dibangun menggunakan **Laravel** dengan tampilan **Bootstrap**, dan database **MySQL**, untuk menggantikan sistem pemesanan tiket manual dengan sistem digital yang lebih efisien, transparan, dan mudah dipantau baik oleh pengunjung maupun pengelola.

---

## 📋 Deskripsi Aplikasi

Aplikasi ini memungkinkan wisatawan untuk melihat daftar destinasi wisata populer di Kabupaten Ende (seperti Danau Kelimutu, Pantai Enabara, Bukit Liaga, dan lainnya), memesan tiket kunjungan secara online, melakukan pembayaran melalui transfer bank/e-wallet, dan menerima e-tiket berbentuk QR Code yang dapat dipindai oleh petugas di lokasi wisata untuk verifikasi keaslian tiket.

Di sisi lain, admin memiliki dashboard khusus untuk mengelola seluruh data pemesanan, destinasi wisata, pengguna terdaftar, metode pembayaran, serta laporan penjualan tiket.

---

## ✨ Fitur Utama

### Untuk Pengunjung (User)
- Registrasi dan login akun
- Melihat daftar destinasi wisata lengkap dengan gambar, lokasi, deskripsi, harga, dan peta lokasi (Google Maps)
- Memesan tiket dengan memilih destinasi, tanggal kunjungan, dan jumlah tiket
- Melakukan pembayaran dengan memilih metode (transfer bank/e-wallet) dan mengunggah bukti pembayaran
- Melihat riwayat pemesanan beserta statusnya (menunggu, dikonfirmasi, ditolak, dibatalkan, refund)
- Menerima notifikasi refund dari admin beserta alasannya, dan melakukan pembayaran ulang jika ada kekurangan bayar
- Mengunduh/mencetak e-tiket berisi QR Code setelah pemesanan dikonfirmasi

### Untuk Admin
- Dashboard ringkasan statistik (total pemesanan, total pengguna, jumlah destinasi, total pendapatan)
- **Kelola Pemesanan** — konfirmasi, tolak, refund (dengan catatan alasan & nominal kurang bayar), hapus pemesanan, serta melihat bukti pembayaran pengguna
- **Kelola Destinasi** — tambah, edit, dan hapus destinasi wisata beserta harga, lokasi, deskripsi, dan gambar
- **Kelola Pengguna** — melihat daftar seluruh pengguna terdaftar dan menghapus akun pengguna
- **Kelola Metode Pembayaran** — tambah, edit, aktif/nonaktifkan metode pembayaran (bank/e-wallet) yang otomatis muncul di halaman checkout
- **Laporan Penjualan** — ringkasan penjualan harian/bulanan, serta ekspor data ke CSV dan Excel
- **Verifikasi Tiket** — memindai QR Code tiket pengunjung untuk memeriksa keabsahan dan menandai tiket sebagai sudah digunakan

---

## 🖥️ Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Backend Framework | Laravel 12 |
| Bahasa Pemrograman | PHP 8.2 |
| Frontend | Blade Templating Engine + Bootstrap 5 |
| Database | MySQL 8.0 |
| Autentikasi | Laravel Auth (session-based) |
| Kontainerisasi | Docker & Docker Compose |

---

## 📖 Panduan Penggunaan

### Alur Pengunjung (User)
1. Buka halaman utama, klik **Daftar** untuk membuat akun baru, atau **Masuk** jika sudah punya akun.
2. Setelah login, buka menu **Destinasi** untuk melihat pilihan wisata.
3. Klik **Pesan Sekarang** pada destinasi yang diinginkan.
4. Isi tanggal kunjungan dan jumlah tiket, lalu klik **Lanjut ke Pembayaran**.
5. Pilih metode pembayaran, transfer sesuai nominal, lalu unggah bukti pembayaran.
6. Setelah admin mengonfirmasi, tiket berstatus **Dikonfirmasi** dan e-tiket berisi QR Code dapat diunduh/dicetak dari menu **Dashboard Saya**.
7. Tunjukkan QR Code kepada petugas di lokasi wisata untuk verifikasi masuk.

### Alur Admin
1. Login menggunakan akun dengan role `admin`.
2. Admin otomatis diarahkan ke **Dashboard Administrator**.
3. Gunakan menu navigasi (Kelola Pemesanan, Kelola Destinasi, Kelola Pengguna, Metode Pembayaran, Laporan) untuk mengelola sistem.
4. Untuk memverifikasi tiket pengunjung di lokasi wisata, buka halaman `/verifikasi` di perangkat petugas, lalu pindai QR Code atau masukkan kode booking secara manual.

### Akun Admin Default
Setelah instalasi, buat akun admin melalui perintah berikut (lihat langkah lengkap di bagian Docker di bawah):
```
Email    : admin@wisataende.com
Password : admin123
```

---

## 🐳 Panduan Menjalankan Aplikasi dengan Docker

Aplikasi ini sudah dilengkapi konfigurasi Docker sehingga dapat dijalankan tanpa perlu menginstal PHP, Composer, atau MySQL secara manual di komputer.

### Prasyarat
- [Docker](https://www.docker.com/products/docker-desktop/) dan Docker Compose sudah terinstal di komputer.

### 1. Clone repository
```bash
git clone https://github.com/username/tiketkabende.git
cd tiketkabende
```

### 2. Siapkan file environment
Salin file contoh environment, lalu sesuaikan jika perlu (nilai default sudah cocok dengan `docker-compose.yml`):
```bash
cp .env.example .env
```

### 3. Build dan jalankan container
```bash
docker compose up -d --build
```

Perintah ini akan menjalankan 3 container:
| Service | Fungsi | Akses |
|---|---|---|
| `app` | Aplikasi Laravel (PHP + Apache) | http://localhost:8000 |
| `db` | Database MySQL | localhost:3307 |
| `phpmyadmin` | Antarmuka untuk melihat isi database | http://localhost:8080 |

Saat pertama kali dijalankan, container `app` akan otomatis:
- Menunggu database siap
- Generate `APP_KEY`
- Menjalankan migration (`php artisan migrate`)
- Membuat storage link (`php artisan storage:link`)

### 4. Buat akun admin
Setelah container berjalan, buat akun admin dengan masuk ke dalam container:
```bash
docker compose exec app php artisan tinker
```
Lalu jalankan:
```php
\App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@wisataende.com',
    'phone' => '0000000000',
    'password' => bcrypt('admin123'),
    'role' => 'admin',
]);
```
Ketik `exit` untuk keluar.

### 5. Akses aplikasi
Buka browser dan kunjungi:
```
http://localhost:8000
```

### Perintah Docker yang berguna
```bash
# Melihat log aplikasi
docker compose logs -f app

# Masuk ke terminal container
docker compose exec app bash

# Menjalankan artisan command
docker compose exec app php artisan migrate:fresh --seed

# Menghentikan seluruh container
docker compose down

# Menghentikan container sekaligus menghapus volume database (reset total)
docker compose down -v
```

---

## 🗂️ Struktur Direktori Utama

```
tiketkabende/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # AuthController, dsb.
│   │   └── Middleware/        # IsAdmin.php
│   └── Models/                # User, Booking, Destinasi, MetodePembayaran
├── database/
│   └── migrations/            # Skema tabel: users, bookings, destinasi, metode_pembayaran
├── resources/
│   └── views/                 # Seluruh tampilan Blade (booking, payment, dashboard-admin, dst.)
├── routes/
│   └── web.php                # Seluruh routing aplikasi
├── public/                    # Document root Laravel
├── Dockerfile                 # Konfigurasi image Docker aplikasi
├── docker-compose.yml         # Orkestrasi container app + db + phpmyadmin
├── docker-entrypoint.sh       # Script otomatisasi setup saat container start
└── README.md
```

---

## 👤 Kontribusi & Lisensi

Proyek ini dikembangkan sebagai bagian dari Tugas Akhir/Skripsi Program Studi Sistem Informasi. Silakan hubungi penulis untuk pertanyaan lebih lanjut terkait pengembangan atau penggunaan kode ini.