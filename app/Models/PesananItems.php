<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananItems extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'pesanan_items';
    //mapping kolom atau field
    protected $fillable = [
        'qty', 'harga', 'produk_id', 'pesanan_id'
    ];
    public $timestamps = false;
    //relasi antara table
    public function produk(){
        return $this->belongsTo(produk::class);
    }
    public function pesanan(){
        return $this->belongsTo(pesanan::class);
    }
}