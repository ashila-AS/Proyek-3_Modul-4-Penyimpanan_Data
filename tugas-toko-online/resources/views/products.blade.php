@extends('layouts.app')
@section('title', 'Daftar Barang')

@section('content')
    <h1>Daftar Barang</h1>

    <div style="display:flex; flex-wrap:wrap; gap:16px">
        @foreach ($products as $p)
            <div style="border:1px solid #ccc; padding:12px; width:180px">
                <img src="/images/{{ $p->gambar }}" alt="{{ $p->nama_barang }}"
                     width="150" height="150" style="object-fit:cover"
                     onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'150\' height=\'150\'><rect width=\'100%25\' height=\'100%25\' fill=\'%23ddd\'/></svg>'">
                <h3 style="margin:8px 0 4px">{{ $p->nama_barang }}</h3>
                <p style="margin:0">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                <p style="margin:4px 0">Stok: {{ $p->stok }}</p>

                @if ($p->stok <= 0)
                    <button disabled>Stok habis</button>
                @else
                    @auth
                        <form method="POST" action="/keranjang/tambah/{{ $p->id_barang }}">
                            @csrf
                            <button type="submit">Masukkan ke keranjang</button>
                        </form>
                    @else
                        <a href="/login">Login untuk membeli</a>
                    @endauth
                @endif
            </div>
        @endforeach
    </div>
@endsection