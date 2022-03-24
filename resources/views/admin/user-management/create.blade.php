@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Tambah User</li>
        </ol>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tambah User</h1>
        </div>
    </div>
    <!--/.row-->
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading">Form Input Tambah User
            <a href="{{ route('user-management.index') }}" class="btn btn-default" style="float: right;"><span
                    class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form action="{{ route('user-management.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group  @error('name') has-error @enderror">
                            <label for="">Username</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                placeholder="Username">
                            @error('name')
                                <span class="invalid-feedback" style="color: red" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('email') has-error @enderror">
                            <label for="">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" style="color: red" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group  @error('email') has-error @enderror">
                            <label for="">Password</label>
                            <input type="password" class="form-control  @error('email') is-invalid @enderror"
                                name="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" style="color: red" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Select Role</label>
                            <br>
                            <select name="role[]" class="form-control">
                                @foreach ($roles as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
