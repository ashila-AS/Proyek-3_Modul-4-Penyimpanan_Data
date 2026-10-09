<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Keranjang Belanja</title></head>
<body>
    <h1>Keranjang belanja Tanpa login</h1>
    <p><a href="/">&laquo; Kembali ke daftar barang</a></p>

    @if (session('pesan'))
        <p style="color:red">{{ session('pesan') }}</p>
    @endif

    @forelse ($items as $item)
        <p>
            <strong>{{ $item['barang']->nama }}</strong><br>
            Rp {{ number_format($item['barang']->harga, 0, ',', '.') }}
            x {{ $item['jumlah'] }}
            = Rp {{ number_format($item['subtotal'], 0, ',', '.') }}

            <form method="POST" action="/keranjang/ubah/{{ $item['barang']->id }}" style="display:inline">
                @csrf
                <input type="hidden" name="aksi" value="kurang">
                <button type="submit">-</button>
            </form>
            {{ $item['jumlah'] }}
            <form method="POST" action="/keranjang/ubah/{{ $item['barang']->id }}" style="display:inline">
                @csrf
                <input type="hidden" name="aksi" value="tambah">
                <button type="submit">+</button>
            </form>
            <form method="POST" action="/keranjang/hapus/{{ $item['barang']->id }}" style="display:inline">
                @csrf
                <button type="submit">hps</button>
            </form>
        </p>
    @empty
        <p>Keranjang masih kosong.</p>
    @endforelse

    <hr>
    <p><strong>Total Rp {{ number_format($total, 0, ',', '.') }}</strong></p>

    <form method="POST" action="/keranjang/kosongkan">
        @csrf
        <button type="submit">Kosongkan keranjang</button>
    </form>
</body>
</html>