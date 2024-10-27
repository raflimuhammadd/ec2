<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Http\Resources\ProdukResource;

class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
        ->select('produk.*', 'kategori.nama_kategori')
        ->get();
        return new ProdukResource(true, 'Data Produk', $produk);
    }
    public function show($id){
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
        ->select('produk.*', 'kategori.nama_kategori')
        ->where('produk.id', $id)
        ->get();
        return new ProdukResource(true, 'Data Produk', $produk);
    }
    public function store(Request $request)
    {

        // $request->validate([
            $validator = Validator::make($request->all(),[
                'kode' => 'required|unique:produk|max:10',
                'nama_produk' => 'required|max:45',
                'harga' => 'required|numeric',
                'deskripsi' => 'nullable|string|min:5',
                'kategori_id' => 'required|integer',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
    }
    DB::table('produk')->insert([
            'kode' => $request->kode,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'foto' => $request->foto,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
    ]);
    return new ProdukResource(true, 'Data Produk Berhasil ditambahkan', 'produk');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'kode' => 'required|max:10',
            'nama_produk' => 'required|max:45',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string|min:5',
            'kategori_id' => 'required|integer',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(), 442);
    }
    $produk = Produk::whereId($id)->update([
        'kode' => $request->kode,
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'foto' => $request->foto,
        'deskripsi' => $request->deskripsi,
        'kategori_id' => $request->kategori_id,
    ]);
    return new ProdukResource(true, 'Data Berhasil diupdate', $produk);

    }

    public function destroy($id){
        $produk = Produk::whereId($id)->first();
        $produk->delete();
        return new ProdukResource(true, 'Data Berhasil dihapus', $produk);
    }
}
