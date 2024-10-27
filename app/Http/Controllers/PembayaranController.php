<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pesanan = Pesanan::all();
        return view('admin.pembayaran.create', compact('pesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'tanggal_pembayaran' => 'required',
                'jumlah_bayar' => 'required|numeric',
                'pesanan_id' => 'required',
            ],
            [
                'tanggal_pembayaran.required' => 'Tanggal Wajib Diisi',
                'jumlah_bayar.required' => 'Jumlah Bayar Harus Diisi',
                'jumlah_bayar.numeric' => 'Masukkan Angka Yang Benar',
                'pesanan_id.required' => 'Masukkan Data Yang Benar',
            ],
        );
        //
        $pembayaran = new Pembayaran;
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar;
        $pembayaran->pesanan_id = $request->pesanan_id;
        $pembayaran->save();
        return redirect('admin/pembayaran/')->with('success', 'Pembayaran Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pembayaran = Pembayaran::all()->where('id', $id);
        return view('admin.pembayaran.detail', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pembayaran = Pembayaran::all()->where('id', $id);
        $pesanan = Pesanan::all();
        return view('admin.pembayaran.edit', compact('pembayaran', 'pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'tanggal_pembayaran' => 'required',
                'jumlah_bayar' => 'required|numeric',
                'pesanan_id' => 'required',
            ],
            [
                'tanggal_pembayaran.required' => 'Tanggal Wajib Diisi',
                'jumlah_bayar.required' => 'Jumlah Bayar Harus Diisi',
                'jumlah_bayar.numeric' => 'Masukkan Angka Yang Benar',
                'pesanan_id.required' => 'Masukkan Data Yang Benar',
            ],
        );
        //
        $pembayaran = Pembayaran::find($request->id);
        $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
        $pembayaran->jumlah_bayar = $request->jumlah_bayar;
        $pembayaran->pesanan_id = $request->pesanan_id;
        $pembayaran->save();
        return redirect('admin/pembayaran/')->with('success', 'Pembayaran Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pembayaran = Pembayaran::where('id', $id)->delete();
        return redirect('admin/pembayaran/')->withSuccess('Berhasil Menghapus Data Pembayaran!');
    }

    public function pembayaranPDF()
    {
        $pembayaran = Pembayaran::all();
        $pdf = PDF::loadView('admin.pembayaran.pembayaranPDF', ['pembayaran' => $pembayaran])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function pembayaranPDF_show(String $id)
    {
        $pembayaran = Pembayaran::all()->where('id', $id);
        $pdf = PDF::loadView('admin.pembayaran.pembayaranPDF_show', ['pembayaran' => $pembayaran]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcomme to export PDF',
            'date' => date("Y-d-m H:i:s"),
            'pembayaran' => Pembayaran::all(),
        ];
        $pdf = PDF::loadView('admin.pembayaran.myPDF', $data);
        return $pdf->download('testdowload.pdf');
    }
    public function exportPembayaran(){
        return Excel::download(new PembayaranExport, 'pembayaran.xlsx');
    }
}
