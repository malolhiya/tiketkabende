<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  protected $fillable = [
    'user_id',
    'kode_booking',
    'destinasi',
    'tanggal',
    'jumlah',
    'total',
    'metode',
    'bukti',
    'status',
    'catatan_refund',
    'nominal_kurang',
      'checked_in_at',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}