<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProdukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $produk = Produk::join('kategori', 'kategori_id', '=', 'kategori.id')
            ->select('produk.kode', 'produk.nama_produk', 'produk.harga', 'kategori.nama_kategori')
            ->get();
        return $produk;
    }

    public function headings(): array
    {
        return ["Kode", "Nama Produk", "Harga", "Kategori"];
    }
}
