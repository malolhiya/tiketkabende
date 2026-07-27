<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $table = 'metode_pembayaran';

    protected $fillable = [
        'tipe',
        'nama',
        'nomor',
        'atas_nama',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}