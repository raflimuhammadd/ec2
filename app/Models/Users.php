<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role'
    ];
    public $timestamps = false;
    public function pelanggan(){
        return $this->hasMany(Pelanggan::class);
    }
}