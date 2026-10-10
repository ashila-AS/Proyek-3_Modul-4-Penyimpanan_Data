@extends('layouts.app')
@section('title', 'Riwayat Pesanan')

@section('content')
    <h1>Riwayat Pesanan</h1>

    @if ($orders->isEmpty())
        <p>Belum ada pesanan.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No. Pesanan</th><th>Tanggal</th><th>Total</th><th>Detail</th>
            </tr>
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $o->id_order }}</td>
                    <td>{{ \Carbon\Carbon::parse($o->tanggal_order)->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                    <td><a href="/pesanan/{{ $o->id_order }}">Lihat</a></td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection