<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Session;
use App\Exports\bmExport;
use App\Exports\bkExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\bmImport;
use App\Imports\bkImport;
use Alert;
use Validator;

class ReportController extends Controller
{
    public function index(){
        return view('admin.cetak-laporan.index');
    }

    public function view(Request $request) {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;
        $pilih = $request->cetak;
        if($end >= $start){
                if ($pilih == "masuk") {
                    $bm = BarangMasuk::whereBetween('tanggal_masuk', [$start, $end])
                        ->get();
                    return view('admin.cetak-laporan.laporan-bm', compact('bm','start','end'));
                } else if ($pilih == "keluar") {
                    $bk = BarangKeluar::whereBetween('tanggal_keluar', [$start, $end])
                        ->get();
                    return view('admin.cetak-laporan.laporan-bk', compact('bk','start','end'));
                }
    }
    elseif($end < $start){
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tanggal Yang Dimasukkan Tidak Valid"
            ]);
            return redirect()->back();
        }
}

    public function laporan(Request $request){
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;
        $pilih = $request->cetak;

        

        if($end >= $start){
            if($pilih == "masuk"){
                $jumlah_masuk = 0;
                $bm = BarangMasuk::whereBetween('tanggal_masuk', [$start, $end, $jumlah_masuk])
                ->get();
        foreach ($bm as $value) {
            $jumlah_masuk += $value->qty;
        }
                $pdf   = \PDF::loadview('admin.cetak-laporan.cetak-bm', compact('bm','start','end', 'jumlah_masuk'));
                return $pdf->download('laporan-barang-masuk.pdf');
            }
            elseif($pilih == "keluar"){
                $jumlah_keluar = 0;
                $bk = BarangKeluar::whereBetween('tanggal_keluar', [$start, $end, $jumlah_keluar])
                ->get();
                foreach ($bk as $value) {
            $jumlah_keluar += $value->qty;
        }
                $pdf   = \PDF::loadview('admin.cetak-laporan.cetak-bk', compact('bk','start','end', 'jumlah_keluar'));
                return $pdf->download('laporan-barang-keluar.pdf');
            }
        }
        elseif($end < $start){
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tanggal Yang Dimasukkan Tidak Valid"
            ]);
            return redirect()->back();
        }
    }

    public function exportBm()
    {
        return Excel::download(new bmExport, 'barang-masuk.xlsx');
    }

    public function exportBk()
    {
        return Excel::download(new bkExport, 'barang-keluar.xlsx');
    }

    public function import_bm(Request $request) 
	{
		// validasi
		// $this->validate($request, [
		// 	'file' => 'required|mimes:csv,xls,xlsx'
		// ]);

        $rules = [
            'file' => 'required|mimes:csv,xls,xlsx',
        ];

        $message = [
            'file.required' => 'File harus di isi',
            'file.mimes' => 'File harus format csv, xls, xlsx.',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$importmasuk = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_masuk',$importmasuk);
 
		// import data
		Excel::import(new bmImport, public_path('/file_masuk/'.$importmasuk));
 
		// notifikasi dengan session
Alert::success('Berhasil', 'Data berhasil di import');
        Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data berhasil di import!"
            ]);
 
		// alihkan halaman kembali
		return redirect()->route('barang-masuk.index');
	}

    public function import_bk(Request $request) 
	{
		// validasi
		// $this->validate($request, [
		// 	'file' => 'required|mimes:csv,xls,xlsx'
		// ]);

        $rules = [
            'file' => 'required|mimes:csv,xls,xlsx',
        ];

        $message = [
            'file.required' => 'File harus di isi',
            'file.mimes' => 'File harus format csv, xls, xlsx.',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$importkeluar = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_keluar',$importkeluar);
 
		// import data
		Excel::import(new bkImport, public_path('/file_keluar/'.$importkeluar));
 
		// notifikasi dengan session
Alert::success('Berhasil', 'Data berhasil di import');
        Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Data berhasil di import!"
            ]);
 
		// alihkan halaman kembali
		return redirect()->route('barang-keluar.index');
	}
}

