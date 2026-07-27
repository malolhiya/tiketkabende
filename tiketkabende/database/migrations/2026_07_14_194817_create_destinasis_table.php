<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->string('icon')->default('🏔');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        // Isi data awal sesuai destinasi yang sudah ada
        DB::table('destinasi')->insert([
            [
                'nama' => 'Danau Kelimutu',
                'lokasi' => 'Kecamatan Kelimutu',
                'deskripsi' => 'Danau tiga warna yang terkenal dengan keindahan alamnya yang menakjubkan.',
                'harga' => 150000,
                'icon' => '🌋',
                'gambar' => 'https://mawatu.co.id/wp-content/uploads/2024/05/000043-01_wisata-danau-kelimutu_danau-kelimutu_800x450_ccpdm-min-768x432-1.jpeg',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama' => 'Pantai Enabara',
                'lokasi' => 'Maurole',
                'deskripsi' => 'Pantai dengan pasir putih dan sunset yang memukau.',
                'harga' => 25000,
                'icon' => '🏖️',
                'gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama' => 'Bukit Liaga',
                'lokasi' => 'Kotabaru',
                'deskripsi' => 'Bukit yang indah dengan panorama alam yang luar biasa.',
                'harga' => 35000,
                'icon' => '⛰️',
                'gambar' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama' => 'Air Terjun Murundao',
                'lokasi' => 'Ende Selatan',
                'deskripsi' => 'Air terjun alami yang menawarkan suasana sejuk dan segar.',
                'harga' => 40000,
                'icon' => '💦',
                'gambar' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama' => 'Kampung Adat Wologai',
                'lokasi' => 'Detusoko',
                'deskripsi' => 'Wisata budaya khas Ende yang masih mempertahankan tradisi leluhur.',
                'harga' => 30000,
                'icon' => '🏘️',
                'gambar' => 'https://upload.wikimedia.org/wikipedia/commons/5/58/Wae_Rebo.jpg',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama' => 'Taman Pengasingan Bung Karno',
                'lokasi' => 'Kota Ende',
                'deskripsi' => 'Tempat bersejarah Bung Karno saat menjalani masa pengasingan di Ende.',
                'harga' => 20000,
                'icon' => '🏛️',
                'gambar' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Bung_Karno_Ende.jpg/640px-Bung_Karno_Ende.jpg',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};