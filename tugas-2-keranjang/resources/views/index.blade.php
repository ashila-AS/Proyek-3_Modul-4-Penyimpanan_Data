<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Toko Alat Tulis</title></head>
<body>
    <h1>Toko Alat Tulis</h1>
    <p><a href="/keranjang">[ Keranjang ({{ $jumlahItem }}) ]</a></p>

    @if (session('pesan'))
        <p style="color:red">{{ session('pesan') }}</p>
    @endif

    <h2>Daftar barang</h2>
    @foreach ($barang as $b)
        <p>
            {{ $b->nama }} - Rp {{ number_format($b->harga, 0, ',', '.') }}
            (stok {{ $b->stok }})
            <form method="POST" action="/keranjang/tambah/{{ $b->id }}" style="display:inline">
                @csrf
                <button type="submit">Masukkan ke krj</button>
            </form>
        </p>
    @endforeach
</body>
</html>