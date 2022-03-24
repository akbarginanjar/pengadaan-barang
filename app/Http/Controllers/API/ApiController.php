<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Jenis;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Supplier;
use App\Models\User;
use DB;

class ApiController extends Controller
{

    public function supplier()
    {
        $supplier = Supplier::all();
        return response()->json([
            'success' => true,
            'message' => 'Data supplier',
            'data' => $supplier,
        ], 200);
    }

    public function user()
    {
        $user = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Data user',
            'data' => $user,
        ], 200);
    }

    public function satuan()
    {
        $satuan = Satuan::all();
        return response()->json([
            'success' => true,
            'message' => 'Data satuan',
            'data' => $satuan,
        ], 200);
    }

    public function jenis()
    {
        $jenis = Jenis::all();
        return response()->json([
            'success' => true,
            'message' => 'Data jenis',
            'data' => $jenis,
        ], 200);
    }

    public function barang()
    {
        // $artikel = Article::with('category')->get();
        $barang = DB::table('barangs')
            ->join('satuans', 'barangs.satuan_id', '=', 'satuans.id')
            ->join('jenis', 'barangs.jenis_id', '=', 'jenis.id')
            ->select('barangs.kode_barang', 'barangs.nama_barang', 'barangs.stok', 'jenis.nama_jenis as jenis', 'satuans.nama_satuan as satuan')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'data barang',
            'data' => $barang,
        ], 200);
}

public function barangmasuk()
    {
        $masuk = DB::table('barang_masuks')
            ->join('suppliers', 'barang_masuks.supplier_id', '=', 'suppliers.id')
            ->join('users', 'barang_masuks.user_id', '=', 'users.id')
            ->join('barangs', 'barang_masuks.barang_id', '=', 'barangs.id')
            ->select('barang_masuks.kode_barang_masuk', 'barang_masuks.tanggal_masuk', 'suppliers.nama_supplier as supplier', 'barangs.nama_barang as barang', 'barang_masuks.qty', 'users.name as pelaku')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'data Barang Masuk',
            'data' => $masuk,
        ], 200);
    }

    public function barangkeluar()
    {
        $keluar = DB::table('barang_keluars')
            ->join('users', 'barang_keluars.user_id', '=', 'users.id')
            ->join('barangs', 'barang_keluars.barang_id', '=', 'barangs.id')
            ->select('barang_keluars.kode_barang_keluar', 'barang_keluars.tanggal_keluar', 'barangs.nama_barang as barang', 'barang_keluars.qty', 'users.name as pelaku')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'data Barang keluar',
            'data' => $keluar,
        ], 200);
    }
}