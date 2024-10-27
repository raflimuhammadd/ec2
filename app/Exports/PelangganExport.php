<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PelangganExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pelanggan::select('nama_pelanggan', 'email', 'telepon', 'alamat')->get();
    }

    public function headings(): array
    {
        return ["Nama", "Email ", "Telepon", "Alamat"];
    }
}
