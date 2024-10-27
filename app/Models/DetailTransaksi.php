<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail';

    protected $fillable = [
        'trans_id', 'produk_id', 'quantity', 'harga',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'trans_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
