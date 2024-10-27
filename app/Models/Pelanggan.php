<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    //mapping kolom atau field
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'telepon',
        'alamat',
        'users_id'
    ];

    public $timestamps = false;
    //relasi antara table
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}