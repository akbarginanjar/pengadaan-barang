<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Session;
use Alert;
use Validator;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::all();
        return view('admin.jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis.create');
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
        //     'nama_jenis' => 'required',
        // ]);

        $rules = [
            'nama_jenis' => 'required|max:255',
        ];

        $message = [
            'nama_jenis.required' => 'nama jenis harus di isi',
            'nama_jenis.max' => 'nama jenis maksimal 255 karakter',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $jenis = new Jenis;
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil menyimpan Jenis $jenis->nama_jenis"
        // ]);

        Alert::success('Berhasil', 'Berhasil Menambah Satuan');

        return redirect()->route('jenis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = Jenis::findOrFail($id);
        return view('admin.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'nama_jenis' => 'required',
        // ]);

        $rules = [
            'nama_jenis' => 'required|max:255',
        ];

        $message = [
            'nama_jenis.required' => 'nama jenis harus di isi',
            'nama_jenis.max' => 'nama jenis maksimal 255 karakter',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $jenis = Jenis::findOrFail($id);
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil mengedit Jenis $jenis->nama_jenis"
        // ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Jenis');

        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $jenis = Jenis::findOrFail($id);

        // if(!Jenis::destroy($id)) {
        //     return redirect()->back();
        // } else {
        //     Session::flash("flash_notification", [
        //         "level" => "success",
        //         "message" => "Berhasil menghapus Jenis $jenis->nama_jenis"
        //     ]);
        //     return redirect()->route('jenis.index');
        // }

        // $jenis->delete();

        if (!Jenis::destroy($id)) {
            return redirect()->back();
        }
        Alert::success('Berhasil', 'Data Berhasil Di Hapus');
        return redirect()->route('jenis.index');
    }
}
