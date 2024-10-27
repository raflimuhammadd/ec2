<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('trans.*', 'users.name as nama', 'users.telepon as telp')
            ->get();
        $transaksiLunas = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('trans.*', 'users.name as nama', 'users.telepon as telp')
            ->where('trans.status','=','lunas')
            ->get();
        return view('admin.transaksi.index', compact('transaksi', 'transaksiLunas'));
    }

    public function show(string $id)
    {
        $transaksi = Transaksi::join('users', 'users_id', '=', 'users.id')
            ->select('trans.*', 'users.name as nama', 'users.telepon as telp', 'users.email as email')
            ->where('trans.id', $id)
            ->get();
        $detail = DetailTransaksi::join('trans', 'trans_id', '=', 'trans.id')
            ->join('produk', 'produk_id', '=', 'produk.id')
            ->select('detail.*', 'trans.status as status', 'trans.total as total', 'produk.nama_produk as nama_produk')
            ->where('detail.trans_id', $id)
            ->get();
        return view('admin.transaksi.show', compact('transaksi', 'detail'));
    }

    public function edit(string $id)
    {
        //
        $transaksi = Transaksi::all()->where('id', $id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'status' => 'required|max:20',

            ],
            [
                'status.required' => 'status wajib diisi',

            ]
        );
        //
        $transaksi = Transaksi::find($request->id);
        $transaksi->status = $request->status;
        $transaksi->save();
        return redirect('admin/transaksi/')->with('success', 'transaksi Berhasil update!');
    }
}
