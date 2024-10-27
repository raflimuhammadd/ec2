<?php

namespace App\Exports;

use App\Models\PesananItems;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PesananItemsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pesananItems = PesananItems::join('produk', 'pesanan_items.produk_id', '=', 'produk.id')
        ->join('pesanan', 'pesanan_items.pesanan_id', '=', 'pesanan.id')
        ->select('pesanan_items.qty', 'pesanan_items.harga', 'produk.nama_produk', 'pesanan.tanggal_pesanan')
        ->get();
        return $pesananItems;
    }
    public function headings(): array
    {
        return ["QTY", "Harga", "Nama Produk", "Tanggal Pesanan"];
    }
}
