<?php

namespace App\Http\Controllers;

use App\Exports\PesananItemsExport;
use App\Models\Pesanan;
use App\Models\PesananItems;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PesananItemsController extends Controller
{
    public function index()
    {
        $pesananItems = PesananItems::join('produk', 'pesanan_items.produk_id', '=', 'produk.id')
            ->join('pesanan', 'pesanan_items.pesanan_id', '=', 'pesanan.id')
            ->select('pesanan_items.*', 'produk.nama_produk', 'pesanan.tanggal_pesanan')
            ->get();

        return view('admin.pesananItems.index', compact('pesananItems'));
    }

    public function create()
    {
        //tambah data
        // $produk = DB::table('produk')->get();
        // $pesanan = DB::table('pesanan')->get();
        // return view('admin.pesanan_items.create', compact('produk, pesanan'));

        $produk = Produk::all();
        $pesanan = Pesanan::all();


        // $produk = DB::table('pelanggan')->get();
        // $pesanan = DB::table('pesanan')->get();


        return view('admin.pesananItems.create', compact('produk', 'pesanan'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'qty' => 'required|max:10',
            'qty' => 'required|numeric',
            'harga' => 'required|max:45',
            'harga' => 'required|numeric',
            'produk_id' => 'required|integer',
            'pesanan_id' => 'required|integer',

        ],
        [
            'qty.required' => 'QTY Wajib Diisi',
            'qty.numeric' => 'QTY Wajib diisi angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Wajib diisi angka',
        ]);

        // Tambah data menggunakan query builder
        DB::table('pesanan_items')->insert([
            'qty' => $request->qty,
            'harga' => $request->harga,
            'produk_id' => $request->produk_id,
            'pesanan_id' => $request->pesanan_id,
        ]);

        return redirect('admin/pesananItems')->with('success', 'Pesanan Items Berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $pesananItems = PesananItems::all()->where('id', $id);
        return view('admin.pesananItems.detail', compact('pesananItems'));
    }

    public function edit(string $id)
    {

        $produk = Produk::all(); // Mengambil semua data dari tabel "produk"
        $pesanan = Pesanan::all();
        $pesananItems = DB::table('pesanan_items')->where('id', $id)->get();
        return view('admin.pesananItems.edit', compact('produk', 'pesanan', 'pesananItems'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'qty' => 'required|max:10',
            'qty' => 'required|numeric',
            'harga' => 'required|max:45',
            'harga' => 'required|numeric',
            'produk_id' => 'required|integer',
            'pesanan_id' => 'required|integer',

        ],
        [
            'qty.required' => 'QTY Wajib Diisi',
            'qty.numeric' => 'QTY Wajib diisi angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Wajib diisi angka',
        ]);


        DB::table('pesanan_items')->where('id', $request->id)->update([
            'qty' => $request->qty,
            'harga' => $request->harga,
            'produk_id' => $request->produk_id,
            'pesanan_id' => $request->pesanan_id,
        ]);

        return redirect('admin/pesananItems')->with('success', 'Pesanan Items Berhasil update!');
    }

    public function destroy(string $id)
    {

        DB::table('pesanan_items')->where('id', $id)->delete();
        return redirect('admin/pesananItems')->withSuccess('Berhasil Menghapus Data Pesanan Items!');
    }

    public function pesananItemsPDF()
    {
        $pesananItems = PesananItems::all();
        $pdf = PDF::loadView('admin.pesananItems.pesananItemsPDF', ['pesananItems' => $pesananItems])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function pesananItemsPDF_show(String $id)
    {
        $pesananItems = PesananItems::all()->where('id', $id);
        $pdf = PDF::loadView('admin.pesananItems.pesananItemsPDF_show', ['pesananItems' => $pesananItems]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcomme to export PDF',
            'date' => date("d-m-Y H:i:s"),
            'pesanan_items' => PesananItems::all(),
        ];
        $pdf = PDF::loadView('admin.pesananItems.myPDF', $data);
        return $pdf->download('pesananItems.pdf');
    }

    public function exportPesananItems()
    {
        return Excel::download(new PesananItemsExport(), 'pesananItems.xlsx');
    }
}
