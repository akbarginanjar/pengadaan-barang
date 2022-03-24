<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan barang keluar</title>
</head>

<body>
    @extends('layouts.report')

    @section('content')
        <br>
        <div class="panel panel-default col-md-12">
            <input type="hidden" name="bm" value="bk">
            <h2>Laporan Barang Keluar</h2>
            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl Keluar</th>
                        <th>ID Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1 @endphp
                    <!-- data -->
                    @foreach ($bk as $data)
                        <tr>
                            <td>
                                <center>{{ $no++ }}</center>
                            </td>
                            <td>{{ $data->tanggal_keluar }}</td>
                            <td>{{ $data->kode_barang_keluar }}</td>
                            <td>{{ $data->barang->nama_barang }}</td>
                            <td>
                                <center>{{ $data->qty }}</center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br>
        </div>
        <center>
            <form action="{{ route('cetak.laporan') }}" method="post">
                <input type="hidden" name="tanggal_awal" value="{{ $start }}">
                <input type="hidden" name="tanggal_akhir" value="{{ $end }}">
                <input type="hidden" name="cetak" value="keluar">
                @csrf
                <button name="submit" type="submit" class="btn btn-primary btn-block btn-lg">
                    <em class="fa fa-print">&nbsp;</em> Cetak</button>
            </form>
        </center>
    @endsection
</body>

</html>
