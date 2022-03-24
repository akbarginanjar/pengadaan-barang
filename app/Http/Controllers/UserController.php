<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Alert;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $roles = Role::all();
        return view('admin.user-management.index', compact('user', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user-management.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        //     'role' => 'required',
        // ]);

         $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'Username harus di isi',
            'name.max' => 'nama barang maksimal 255 karakter',
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password harus di isi',
        ];
        
         $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->attachRoles($request->role);
        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Data saved successfully",
        // ]);
        Alert::success('Berhasil', 'Berhasil menambahkan user');
        return redirect()->route('user-management.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.user-management.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        //     'role' => 'required',
        // ]);
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'Username harus di isi',
            'name.max' => 'nama barang maksimal 255 karakter',
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password harus di isi',
        ];
        
         $validation = Validator::make($request->all(), $rules, $message);
    if ($validation->fails()) {
        Alert::error('Oops', 'Data yang anda input tidak valid, silahkan di ulang')->autoclose(2000);
        return back()->withErrors($validation)->withInput();
    }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->syncRoles($request->role);
        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Data edited successfully",
        // ]);
        Alert::success('Berhasil', 'Berhasil Mengedit user');
        return redirect()->route('user-management.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $user->detachRole($id);
        // Session::flash("flash_notification", [
        //     "level" => "success",
        //     "message" => "Data deleted successfully",
        // ]);
        Alert::success('Berhasil', 'Berhasil Menghapus user');
        return redirect()->route('user-management.index');

    }
}
