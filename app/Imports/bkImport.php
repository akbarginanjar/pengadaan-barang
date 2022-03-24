<?php

namespace App\Imports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\ToModel;

class bkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BarangKeluar([
            'kode_barang_keluar' => $row[1],
            'tanggal_keluar' => $row[2],
            'barang_id' => $row[3],
            'qty' => $row[4],
            'user_id' => $row[5],
        ]);
    }
}
