<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'harga_total',
        'metode_pembayaran',
        'waktu_transaksi',
        'status',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}