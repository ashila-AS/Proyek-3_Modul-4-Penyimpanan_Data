@extends('layouts.app')
@section('title', 'Keranjang Belanja')

@section('content')
    <h1>Keranjang Belanja</h1>
    <p><a href="/">&laquo; Lanjut belanja</a></p>

    @if ($rows->isEmpty())
        <p>Keranjang masih kosong.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th>
            </tr>
            @foreach ($rows as $r)
                <tr>
                    <td>{{ $r->nama_barang }}</td>
                    <td>Rp {{ number_format($r->harga, 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="/keranjang/ubah/{{ $r->id_barang }}" style="display:inline">
                            @csrf <input type="hidden" name="aksi" value="kurang">
                            <button type="submit">-</button>
                        </form>
                        {{ $r->jumlah }}
                        <form method="POST" action="/keranjang/ubah/{{ $r->id_barang }}" style="display:inline">
                            @csrf <input type="hidden" name="aksi" value="tambah">
                            <button type="submit">+</button>
                        </form>
                        <small>(stok {{ $r->stok }})</small>
                    </td>
                    <td>Rp {{ number_format($r->harga * $r->jumlah, 0, ',', '.') }}</td>
                    <td>
                        <form method="POST" action="/keranjang/hapus/{{ $r->id_barang }}">
                            @csrf <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <form method="POST" action="/keranjang/kosongkan" style="margin-top:12px">
            @csrf <button type="submit">Kosongkan keranjang</button>
        </form>

        <h2>Checkout</h2>
        <form method="POST" action="/checkout">
            @csrf
            <p>Alamat pengiriman<br>
                <textarea name="alamat_pengiriman" rows="3" cols="40" required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea></p>
            @error('alamat_pengiriman')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <p>Ongkos kirim diabaikan, total bayar = <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
            <button type="submit">Checkout</button>
        </form>
    @endif
@endsection