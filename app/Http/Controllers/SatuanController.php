<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::all();
        return view('admin.satuan.index', compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nama_satuan' => 'required',
        // ]);

        $rules = [
            'nama_satuan' => 'required|max:255',
        ];

        $message = [
            'nama_satuan.required' => 'nama satuan harus di isi',
            'nama_satuan.max' => 'nama satuan maksimal 255 karakter',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $satuan = new Satuan;
        $satuan->nama_satuan = $request->nama_satuan;
        $satuan->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil menyimpan Satuan $satuan->nama_satuan"
        // ]);

        Alert::success('Berhasil', 'Berhasil Menambahkan Satuan');

        return redirect()->route('satuan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        return view('admin.satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'nama_satuan' => 'required',
        // ]);

        $rules = [
            'nama_satuan' => 'required|max:255',
        ];

        $message = [
            'nama_satuan.required' => 'nama satuan harus di isi',
            'nama_satuan.max' => 'nama satuan maksimal 255 karakter',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $satuan = Satuan::findOrFail($id);
        $satuan->nama_satuan = $request->nama_satuan;
        $satuan->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil mengedit Satuan $satuan->nama_satuan"
        // ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Satuan');

        return redirect()->route('satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $satuan = Satuan::findOrFail($id);

        // if(!Satuan::destroy($id)) {
        //     return redirect()->back();
        // } else {
        //     Session::flash("flash_notification", [
        //         "level" => "success",
        //         "message" => "Berhasil menghapus Satuan $satuan->nama_satuan"
        //     ]);
        //     return redirect()->route('satuan.index');
        // }

        // $satuan->delete();
        if (!Satuan::destroy($id)) {
            return redirect()->back();
        }
        Alert::success('Berhasil', 'Data Berhasil Di Hapus');
        return redirect()->route('satuan.index');
    }
}
