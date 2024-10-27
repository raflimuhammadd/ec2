<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    //mapping kolom atau field
    protected $fillable = [
        'tanggal_pesanan',
        'status',
        'pelanggan_id'
    ];
    public $timestamps = false;
    //relasi antara table
    public function pelanggan(){
        return $this->belongsTo(pelanggan::class);
    }

}