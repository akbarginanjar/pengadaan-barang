<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Validator;
use Illuminate\Http\Request;
use Session;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_supplier' => 'required|max:255',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required|max:225'
        ];

        $message = [
            'nama_supplier.required' => 'nama supplier harus di isi',
            'nama_supplier.unique' => 'nama supplier sudah digunakan',
            'nama_supplier.max' => 'nama supplier maksimal 255 karakter',
            'no_telepon.numeric' => 'hanya boleh di isi oleh angka',
            'no_telepon.required' => 'nama field lain harus di isi',
            'alamat.required' => 'nama field harus di isi',
            'alamat.max' => 'alamat supplier maksimal 255 karakter',
        ];
        //validasi data
        // $validated = $request->validate([
        //     'nama_supplier' => 'required',
        //     'no_telepon' => 'required',
        //     'alamat' => 'required',
        // ]);
         $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $supplier = new Supplier;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil menyimpan Supplier $supplier->nama_supplier"
        // ]);

        Alert::success('Berhasil', 'Berhasil Menambahkan Supplier');


        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'nama_supplier' => 'required|max:255',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required|max:225'
        ];

        $message = [
            'nama_supplier.required' => 'nama supplier harus di isi',
            'nama_supplier.unique' => 'nama supplier sudah digunakan',
            'nama_supplier.max' => 'nama supplier maksimal 255 karakter',
            'no_telepon.numeric' => 'hanya boleh di isi oleh angka',
            'no_telepon.required' => 'nama field lain harus di isi',
            'alamat.required' => 'nama field harus di isi',
            'alamat.max' => 'alamat supplier maksimal 255 karakter',
        ];
        
        $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        //validasi data
        // $validated = $request->validate([
        //     'nama_supplier' => 'required',
        //     'no_telepon' => 'required',
        //     'alamat' => 'required',
        // ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->no_telepon = $request->no_telepon;
        $supplier->alamat = $request->alamat;
        $supplier->save();

        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Berhasil mengedit Supplier $supplier->nama_supplier"
        // ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Supplier');

        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!Supplier::destroy($id)) {
        //     return redirect()->back();
        // } else {
        //     Session::flash("flash_notification", [
        //         "level" => "success",
        //         "message" => "Berhasil menghapus Supplier $supplier->nama_supplier"
        //     ]);
        //     return redirect()->route('supplier.index');
        // }


        if (!Supplier::destroy($id)) {
            return redirect()->back();
        }
        Alert::success('Berhasil', 'Data Berhasil Di Hapus');
        return redirect()->route('supplier.index');
    }
}
