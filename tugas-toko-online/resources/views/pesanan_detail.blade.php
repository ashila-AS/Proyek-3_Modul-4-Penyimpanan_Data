@extends('layouts.app')
@section('title', 'Detail Pesanan')

@section('content')
    <h1>Detail Pesanan {{ $order->id_order }}</h1>
    <p><a href="/pesanan">&laquo; Kembali ke riwayat</a></p>

    <p>Tanggal: {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y H:i') }}<br>
       Alamat pengiriman: {{ $order->alamat_pengiriman }}</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Barang</th><th>Harga satuan</th><th>Jumlah</th><th>Subtotal</th>
        </tr>
        @foreach ($details as $d)
            <tr>
                <td>{{ $d->nama_barang }}</td>
                <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah_beli }}</td>
                <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><strong>Total bayar</strong></td>
            <td><strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
@endsection