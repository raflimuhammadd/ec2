<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PesananExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pesanan = Pesanan::join('pelanggan', 'pelanggan_id', '=', 'pelanggan.id')
        ->select('pesanan.tanggal_pesanan', 'pesanan.status', 'pelanggan.nama_pelanggan')
        ->get();
        return $pesanan;
    }
    public function headings(): array
    {
        return ["Tanggal Pesanan", "Status", "Nama Pelanggan"];
    }
    
}
