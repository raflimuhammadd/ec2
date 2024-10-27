<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\PesananItems;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    
    //fungsi index
    public function index() {
        $produk = Produk::count();
        $kategori = Kategori::count();
        $transaksi = Transaksi::count();
        $pesanan = Pesanan::count();
        $pelanggan = Pelanggan::count();
        $pembayaran = Pembayaran::count();
        $pesanan_items = PesananItems::count();
        
        $status = DB::table('trans')
        ->selectRaw('status, count(status) as jumlah')
        ->groupBy('status')
        ->get();
        $hitung_harga = DB::table('produk')->select('nama_produk', 'harga')->get();
        $hitung_pesanan = DB::table('pesanan_items')->select('qty', 'harga')->get();
        return view('admin.dashboard' , compact('produk', 'kategori', 'pesanan', 'pelanggan', 'transaksi', 'pesanan_items', 'pembayaran', 'hitung_harga', 'status')); //mengarahkan ke file dashboard yang ada di dalam folder admin
    }
}
