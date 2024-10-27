<?php

namespace App\Http\Controllers;

use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;




class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
            ->select('produk.*', 'kategori.nama_kategori')
            ->get();
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        //tambah data
        $kategori = DB::table('kategori')->get();
        return view('admin.produk.create', compact('kategori'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'kode' => 'required|unique:produk| max:10',
            'nama_produk' => 'required|max:45',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,png,svg,webp|max:20000',
            'deskripsi' => 'nullable|string|min:5',
            'kategori_id' => 'required|integer',

        ],
        [
            'kode.max' => 'kode maximal 10 karakter',
            'kode.required' => 'kode Wajib Diisi',
            'kode.unique' => 'kode sudah ada silahkan tambahkan kode lain',
            'nama_produk.required' => 'Nama Wajib Diisi',
            'nama_produk.max' => 'Nama Maksimal 25 karakter',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Wajib diisi angka',
            'foto.max' => 'Maksimal 6 MB',
            'foto.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg, webp',
        ]);

        //proses upload foto
        if (!empty($request->foto)){
            $fileName = 'foto-'.uniqid().'.'.$request->foto->extension();
            $request->foto->move(public_path('admin/img'), $fileName);
        }else{
            $fileName = '';
        }
        // Tambah data menggunakan query builder
        DB::table('produk')->insert([
            'kode' => $request->kode,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'foto' => $fileName,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('admin/produk')->with('success', 'Produk Berhasil ditambahkan!');
    }

    public function show(string $id){
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
        ->select('produk.*', 'kategori.nama_kategori')
        ->where('produk.id', $id)
        ->get();
        return view ('admin.produk.detail', compact('produk'));
    }

    public function edit(string $id){
        $kategori = DB::table('kategori')->get();
        $produk = DB::table('produk')->where('id', $id)->get();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, string $id){

        $request->validate([
            'kode' => 'required |max:10',
            'nama_produk' => 'required|max:45',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,gif,png,svg,webp|max:20000',
            'deskripsi' => 'nullable|string|min:10',
            'kategori_id' => 'required|integer',

        ],
        [
            'kode.required' => 'kode Wajib Diisi',
            'nama_produk.required' => 'Nama Wajib Diisi',
            'harga.required' => 'Harga Wajib Diisi',
            'foto.max' => 'Maksimal 4 MB',
            'foto.image' => 'File ekstensi harus jpg, jpeg, gif, png, svg, webp',
        ]);

        $foto = DB::table('produk')->select('foto')->where('id', $request->id)->get();
    foreach ($foto as $f){
        $namaFileFotoLama = $f->foto;
    }
    if(!empty($request->foto)){
        //jika ada foto lama maka hapus fotonya
    if(!empty($namaFileFotoLama->foto)) unlink('admin/img'.$namaFileFotoLama->foto);
    //proses ganti foto
    $fileName = 'foto-'.$request->id . '.' . $request->foto->extension();
    $request->foto->move(public_path('admin/img'), $fileName);
    } else {
        $fileName = '';
    }
    DB::table('produk')->where('id',$request->id)->update([
        'kode' => $request->kode,
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'foto' => $fileName,
        'deskripsi' => $request->deskripsi,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect('admin/produk')->with('success', 'Produk Berhasil update!');
    }

    public function destroy(string $id){

        DB::table('produk')->where('id', $id)->delete();
        return redirect('admin/produk')->withSuccess('Berhasil Menghapus Data Produk!');
    }

    public function produkPDF()
    {
        $produk = Produk::all();
        $pdf = PDF::loadView('admin.produk.produkPDF', ['produk' => $produk])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function produkPDF_show(String $id)
    {
        $produk = Produk::all()->where('id', $id);
        $pdf = PDF::loadView('admin.produk.produkPDF_show', ['produk' => $produk]);
        return $pdf->stream();
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to export PDF',
            'date' => date("d-m-Y H:i:s"),
            'produk' => Produk::all(),
        ];
        $pdf = PDF::loadView('admin.produk.myPDF', $data);
        return $pdf->download('Produk.pdf');
    }

    public function exportProduk()
    {
        return Excel::download(new ProdukExport(), 'produk.xlsx');
    }

    public function importProduk(Request $request)
    {

        // $file = $request->file('file');
        // $nama_file = rand().$file->getClientOriginalName();
        // $file->move(public_path('/file_excel'), $nama_file);
        // Excel::import(new ProdukImport, public_path('/file_excel'. '/' .$nama_file));
        Excel::import(new ProdukImport, $request->file('file')->store('temp'));

        return redirect('admin/produk')->with('success', 'Data produk berhasil diimpor!');
    }




}
