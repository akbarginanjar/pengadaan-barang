@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Barang Masuk</li>
        </ol>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Barang Masuk</h1>
        </div><br><br>
        <div class="col-sm-1">
            <a href="export-bm" class="btn btn-success" style="float: right;">EXPORT EXCEL</a>
        </div>
        <div class="">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importExcel">
                IMPORT EXCEL
            </button>
        </div>
    </div><br>
    <!--/.row-->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#barang-masuk').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading"> Barang Masuk
            <a href="{{ route('barang-masuk.create') }}" class="btn btn-primary" style="float: right;"><span
                    class="fa fa-plus">&nbsp;</span> tambah</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="barang-masuk" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Barang Masuk</th>
                            <th class="text-center">Tanggal Masuk</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Penerima</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- data palsu -->
                        @php $no=1 @endphp
                        <!-- data -->
                        @foreach ($masuk as $data)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $data->kode_barang_masuk }}</td>
                                <td class="text-center">{{ $data->tanggal_masuk }}</td>
                                <td class="text-center">{{ $data->supplier->nama_supplier }}</td>
                                <td class="text-center">{{ $data->barang->nama_barang }}</td>
                                <td class="text-center">{{ $data->qty }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td class="text-center">
                                    <form class="text-center" action="{{ route('barang-masuk.destroy', $data->id) }}"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="{{ route('barang-masuk.edit', $data->id) }}"
                                            class="btn btn-warning fa fa-edit"></a>
                                        <button type="submit" class="btn btn-danger fa fa-trash delete-confirm"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Import Excel -->
        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('import-bm.import_bm') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Import Excel</h3>
                        </div>
                        <div class="modal-body">

                            {{ csrf_field() }}

                            <label>Pilih file excel</label>
                            <div class="form-group @error('file') has-error @enderror">
                                <input type="file" class="form-control @error('file') has-error @enderror" name="file">
                                @error('file')
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
