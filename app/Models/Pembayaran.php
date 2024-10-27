<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    //mapping kolom atau field
    protected $fillable = [
        'tanggal_pembayaran', 'jumlah_bayar', 'pesanan_id'
    ];
    public $timestamps = false;
    //relasi antara table
    public function pesanan(){
        return $this->belongsTo(Pesanan::class);
    }
}