<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'trans';

    protected $fillable = [
        'users_id', 'total',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'trans_id');
    }
}
