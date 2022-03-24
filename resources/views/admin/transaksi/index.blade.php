@extends('layouts.app')

@section('header')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Transaksi</li>
        </ol>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transaksi</h1>
        </div>
    </div>
    <!--/.row-->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#transaksi').DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

@section('content')
    <div class="panel panel-default col-md-12">
        <div class="panel-heading">
            Transaksi
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="transaksi" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Tanggal Transaksi</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Penerima / Pengeluar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- data palsu -->
                        @php $no=1 @endphp
                        <!-- data -->
                        @foreach ($transaksi as $data)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $data->jenis }}</td>
                                <td class="text-center">{{ $data->tanggal_transaksi }}</td>
                                <td class="text-center">{{ $data->barang->nama_barang }}</td>
                                <td class="text-center">{{ $data->qty }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td class="text-center">
                                    <form class="text-center" action="{{ route('transaksi.destroy', $data->id) }}"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger fa fa-trash delete-confirm"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
