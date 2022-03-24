@extends('layouts.report')

@section('content')
<style>
    body {
        background: white;
    }
    h1 {
        font-weight: bold;
        font-size: 50px;
        letter-spacing: 5px;
    }
    h2 {
        font-size: 100px;
    }
    a {
        color: white;
        padding: 10px 80px;
        border: 0;
        border-radius: 5px;
        font-size: 20px;
        background-color: rgb(62, 128, 250);
    }
    a:hover {
        background-color: rgb(90, 181, 255);
        color: white;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    p {
        color: rgb(161, 161, 161);
        text-align: center;
        font-size: 20px;
    }
</style>
                 <h1>Not Found</h1>
                 <h2>404</h2>
                 <p>Klik tombol ini untuk kembali ke Home</p><br>
                 <a href="/home">Kembali Ke Home</a>
             @endsection