<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\ToModel;

class bmImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BarangMasuk([
            'kode_barang_masuk' => $row[1],
            'tanggal_masuk' => $row[2],
            'supplier_id' => $row[3],
            'barang_id' => $row[4],
            'qty' => $row[5],
            'user_id' => $row[6],
        ]);
    }
}
