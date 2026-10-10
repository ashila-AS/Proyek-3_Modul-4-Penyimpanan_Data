<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Toko Online')</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        nav { background: #1a57a0; color: #fff; padding: 12px 24px; display: flex; gap: 16px; align-items: center; }
        nav a { color: #fff; text-decoration: none; }
        nav .kanan { margin-left: auto; display: flex; gap: 16px; align-items: center; }
        nav button { background: none; border: 1px solid #fff; color: #fff; cursor: pointer; padding: 4px 10px; }
        main { padding: 24px; }
        .pesan { padding: 8px 12px; margin-bottom: 12px; }
        .sukses { background: #dff0d8; color: #2d6a2d; }
        .gagal { background: #f8d7da; color: #a12; }
    </style>
</head>
<body>
    <nav>
        <a href="/"><strong>Toko Online</strong></a>
        <div class="kanan">
            @auth
                <span>Halo, {{ auth()->user()->nama_lengkap }}</span>
                <a href="/keranjang">Keranjang ({{ \Illuminate\Support\Facades\DB::table('keranjang')->where('id_user', auth()->id())->sum('jumlah') }})</a>
                <a href="/pesanan">Riwayat Pesanan</a>
                <form method="POST" action="/logout" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
            @endauth
        </div>
    </nav>

    <main>
        @if (session('sukses'))
            <div class="pesan sukses">{{ session('sukses') }}</div>
        @endif
        @if (session('gagal'))
            <div class="pesan gagal">{{ session('gagal') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>