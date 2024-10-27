<?php

namespace App\Imports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\ToModel;

class PelangganImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Pelanggan([
            'nama_pelanggan' => $row[1],
            'email' => $row[2],
            'telepon' => $row[3],
            'alamat' => $row[4],
        ]);
    }
}
