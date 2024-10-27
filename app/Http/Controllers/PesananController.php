<?php

namespace App\Http\Controllers;

use App\Exports\PesananExport;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::join('pelanggan', 'pelanggan_id', '=', 'pelanggan.id')
        ->select('pesanan.*', 'pelanggan.nama_pelanggan')
        ->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }


    public function create()
    {
        //tambah data
        $pelanggan = DB::table('pelanggan')->get();
        return view('admin.pesanan.create', compact('pelanggan'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'tanggal_pesanan' => 'required|date',
            'status' => 'required|string',
            'pelanggan_id' => 'required|integer',

        ],
        [
            'tanggal_pesanan.required' => 'Tanggal wajib diisi',
            'status.required' => 'Status wajib diisi',

        ]);


        // Tambah data menggunakan query builder
        DB::table('pesanan')->insert([
            'tanggal_pesanan' => $request->tanggal_pesanan,
            'status' => $request->status,
            'pelanggan_id' => $request->pelanggan_id,
        ]);

        return redirect('admin/pesanan')->with('success', 'Pesanan Berhasil ditambahkan!');
    }

    public function show(string $id){
        $pesanan = Pesanan::join('pelanggan', 'pelanggan_id', '=', 'pelanggan.id')
        ->select('pesanan.*', 'pelanggan.nama_pelanggan')
        ->where('pesanan.id', $id)
        ->get();
        return view('admin.pesanan.detail', compact('pesanan'));
    }

    public function edit(string $id){
        $pelanggan = DB::table('pelanggan')->get();
        $pesanan = DB::table('pesanan')->where('id', $id)->get();
        return view('admin.pesanan.edit', compact('pelanggan', 'pesanan'));


    }

    public function update(Request $request, string $id){

        $request->validate([
            'tanggal_pesanan' => 'required|date',
            'status' => 'required|string',
            'pelanggan_id' => 'required|integer',

        ],
        [
            'tanggal_pesanan.required' => 'Tanggal wajib diisi',
            'status.required' => 'Status wajib diisi',

        ]);


    DB::table('pesanan')->where('id',$request->id)->update([
        'tanggal_pesanan' => $request->tanggal_pesanan,
        'status' => $request->status,
        'pelanggan_id' => $request->pelanggan_id,
    ]);

    return redirect('admin/pesanan')->with('success', 'Pesanan Berhasil update!');
    }

    public function destroy(string $id){

        DB::table('pesanan')->where('id', $id)->delete();
        return redirect('admin/pesanan')->withSuccess('Berhasil Menghapus Data Pesanan!');
    }

    public function pesananPDF()
    {
        $pesanan = Pesanan::all();
        $pdf = PDF::loadView('admin.pesanan.pesananPDF', ['pesanan' => $pesanan])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function pesananPDF_show(String $id)
    {
        $pesanan = Pesanan::all()->where('id', $id);
        $pdf = PDF::loadView('admin.pesanan.pesananPDF_show', ['pesanan' => $pesanan]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to export PDF',
            'date' => date("d-m-Y H:i:s"),
            'pesanan' => Pesanan::all(),
        ];
        $pdf = PDF::loadView('admin.pesanan.myPDF', $data);
        return $pdf->download('pesanan.pdf');
    }

    public function exportPesanan()
    {
        return Excel::download(new PesananExport(), 'pesanan.xlsx');
    }
}
