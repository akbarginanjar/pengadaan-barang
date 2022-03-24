@extends('layouts.app')

@section('header')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Supplier</li>
			</ol>
		</div><!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Supplier</h1>
			</div>
		</div><!--/.row-->
@endsection

@section('content')
<div class="panel panel-default col-md-12">
    <div class="panel-heading"> Form Edit Supplier
        <a href="{{ route('supplier.index') }}" class="btn btn-default" style="float: right;"><span class="fa fa-arrow-left">&nbsp;</span> Kembali</a>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <form role="form" action="{{ route('supplier.update',$supplier->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group @error('nama_supplier') has-error @enderror">
                    <label>Nama Supplier</label>
                    <input value="{{ $supplier->nama_supplier }}" type="text" name="nama_supplier" class="form-control @error('nama_supplier') is-invalid @enderror" placeholder="Nama Supplier">
                    @error('nama_supplier')
                        <span class="invalid-feedback text-danger" style="color: red" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group  @error('no_telepon') has-error @enderror">
                    <label>Nomor Telepon</label>
                    <input value="{{ $supplier->no_telepon }}" type="number" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" placeholder="No Telepon">
                    @error('no_telepon')
                        <span class="invalid-feedback text-danger" style="color: red" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group  @error('alamat') has-error @enderror">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5" placeholder="Alamat">{{ $supplier->alamat }}</textarea>
                    @error('alamat')
                        <span class="invalid-feedback text-danger" style="color: red" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-default" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

@endsection
