<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create(){

        return view ('admin.kategori.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_kategori' => 'required|unique:kategori|max:20',

        ],
        [
            'nama_kategori.required' => 'kategori wajib diisi',
            'nama_kategori.unique' => 'kategori sudah ada silahkan tambahkan kategori lain',

        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect('admin/kategori')->with('success', 'Kategori Berhasil ditambahkan!');

    }
    public function show(string $id)
    {
        //
        $kategori = Kategori::all()->where('id', $id);
        return view('admin.kategori.detail', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kategori = Kategori::all()->where('id', $id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:20',

        ],
        [
            'nama_kategori.required' => 'kategori wajib diisi',

        ]);
        //
        $kategori = Kategori::find($request->id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect('admin/kategori/')->with('success', 'Kategori Berhasil update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('kategori')->where('id', $id)->delete();
        return redirect('admin/kategori/')->withSuccess('Berhasil Menghapus Data Kategori!');
    }

    public function kategoriPDF()
    {
        $kategori = Kategori::all();
        $pdf = PDF::loadView('admin.kategori.kategoriPDF', ['kategori' => $kategori])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function kategoriPDF_show(String $id)
    {
        $kategori = Kategori::all()->where('id', $id);
        $pdf = PDF::loadView('admin.kategori.kategoriPDF_show', ['kategori' => $kategori]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to export PDF',
            'date' => date("d-m-Y H:i:s"),
            'kategori' => Kategori::all(),
        ];
        $pdf = PDF::loadView('admin.kategori.myPDF', $data);
        return $pdf->download('kategori.pdf');
    }
}
