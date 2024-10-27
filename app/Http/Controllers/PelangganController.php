<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\PelangganExport;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pelanggan = pelanggan::all();
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Users::all();
        return view('admin.pelanggan.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pelanggan' => 'required|max:45',
                'email' => 'required|max:45',
                'telepon' => 'required|numeric',
                'alamat' => 'required|max:45',
            ],
            [
                'nama_pelanggan.required' => 'Nama wajib di isi',
                'email.required' => 'Email wajib di isi',
                'telepon.required' => 'Telepon wajib di isi',
                'alamat.required' => 'Alamat wajib di isi',
            ]
        );


        $pelanggan = new Pelanggan;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();
        // Alert::success('Tambah Data', 'Berhasil menambahkan data');

        return redirect('admin/pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = DB::table('pelanggan')->where('id', $id)->get();
        return view('admin.pelanggan.detail', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = DB::table('pelanggan')->where('id', $id)->get();
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::table('pelanggan')->where('id', $request->id)->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);

            Alert::success('Edit Data', 'Berhasil mengedit data');
            return redirect('admin/pelanggan');
        } catch (\Exception $e) {
            Alert::error('Edit Data', 'Gagal mengedit data');
            return redirect('admin/pelanggan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pelanggan')->where('id', $id)->delete();
        return redirect('admin/pelanggan')->withSuccess('Data pelanggan berhasil dihapus');
    }

    public function pelangganPDF()
    {
        $pelanggan = Pelanggan::all();
        $pdf = PDF::loadView('admin.pelanggan.pelangganPDF', ['pelanggan' => $pelanggan])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function pelangganPDF_show(String $id)
    {
        $pelanggan = Pelanggan::all()->where('id', $id);
        $pdf = PDF::loadView('admin.pelanggan.pelangganPDF_show', ['pelanggan' => $pelanggan]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcomme to export PDF',
            'date' => date("Y-d-m H:i:s"),
            'pelanggan' => Pelanggan::all(),
        ];
        $pdf = PDF::loadView('admin.pelanggan.myPDF', $data);
        return $pdf->download('testdowload.pdf');
    }

    public function exportPelanggan()
    {
        return Excel::download(new PelangganExport(), 'pelanggan.xlsx');
    }
}
