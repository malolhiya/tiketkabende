<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('catatan_refund')->nullable()->after('status');
            $table->integer('nominal_kurang')->nullable()->after('catatan_refund');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['catatan_refund', 'nominal_kurang']);
        });
    }
};