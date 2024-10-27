<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    //mapping kolom atau field
    protected $fillable = [
        'kode','nama_produk', 'harga', 'foto','deskripsi', 'kategori_id'
    ];
    public $timestamps = false;
    //relasi antara table
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id');
    }
}
