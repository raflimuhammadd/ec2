<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pembayaran = Pembayaran::join('pesanan', 'pesanan_id', '=', 'pesanan.id')
        ->select('pembayaran.tanggal_pembayaran', 'pembayaran.jumlah_bayar', 'pesanan.tanggal_pesanan as pesanTanggal', 'pesanan.status as pesananStatus')
        -> get();
        return $pembayaran;
    }

    public function headings(): array
    {
        return ["Tanggal Pembayaran","Jumlah Pembayaran","Tanggal Pesanan", "Status Pesanan"];
    }
}
