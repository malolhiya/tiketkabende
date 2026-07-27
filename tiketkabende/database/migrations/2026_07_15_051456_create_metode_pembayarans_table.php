<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metode_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('tipe'); // 'Bank' atau 'E-Wallet'
            $table->string('nama'); // BRI, GoPay, dst
            $table->string('nomor'); // no rekening / no HP
            $table->string('atas_nama');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        DB::table('metode_pembayaran')->insert([
            ['tipe' => 'Bank', 'nama' => 'BRI', 'nomor' => '1234567890', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['tipe' => 'Bank', 'nama' => 'Mandiri', 'nomor' => '0987654321', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['tipe' => 'Bank', 'nama' => 'BCA', 'nomor' => '5551234567', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['tipe' => 'E-Wallet', 'nama' => 'GoPay', 'nomor' => '081234567890', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['tipe' => 'E-Wallet', 'nama' => 'OVO', 'nomor' => '081234567890', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['tipe' => 'E-Wallet', 'nama' => 'DANA', 'nomor' => '081234567890', 'atas_nama' => 'Wisata Ende Official', 'aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('metode_pembayaran');
    }
};