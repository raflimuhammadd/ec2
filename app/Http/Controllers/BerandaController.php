<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // public function index(){
    //     $produk = Produk::where('kategori_id', 9090)->get();

    //     return view('beranda', compact('produk'));
    // }

    public function index(){
        $produk = Produk::orderBy('nama_produk', 'desc')->limit(3)->get();
        return view('beranda', compact('produk'));
    }

}
