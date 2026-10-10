<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        $rows = DB::table('keranjang')
            ->join('products', 'products.id_barang', '=', 'keranjang.id_barang')
            ->where('keranjang.id_user', auth()->id())
            ->select('products.id_barang', 'products.nama_barang', 'products.harga',
                     'products.stok', 'keranjang.jumlah')
            ->orderBy('products.id_barang')
            ->get();

        $total = $rows->sum(fn ($r) => $r->harga * $r->jumlah);

        return view('keranjang', compact('rows', 'total'));
    }

    public function tambah($id)
    {
        $p = Product::findOrFail($id);

        if ($p->stok <= 0) {
            return back()->with('gagal', 'Barang stok habis, tidak dapat dibeli.');
        }

        $ada = DB::table('keranjang')
            ->where('id_user', auth()->id())
            ->where('id_barang', $p->id_barang)
            ->value('jumlah') ?? 0;

        if ($ada + 1 > $p->stok) {
            return back()->with('gagal', 'Jumlah melebihi stok tersedia.');
        }

        DB::table('keranjang')->updateOrInsert(
            ['id_user' => auth()->id(), 'id_barang' => $p->id_barang],
            ['jumlah' => $ada + 1]
        );

        return back()->with('sukses', $p->nama_barang . ' masuk ke keranjang.');
    }

    public function ubah(Request $request, $id)
    {
        $p = Product::findOrFail($id);

        $ada = DB::table('keranjang')
            ->where('id_user', auth()->id())
            ->where('id_barang', $p->id_barang)
            ->value('jumlah');

        if ($ada === null) {
            return redirect('/keranjang');
        }

        $baru = $ada + ($request->aksi === 'tambah' ? 1 : -1);

        if ($baru <= 0) {
            DB::table('keranjang')
                ->where('id_user', auth()->id())
                ->where('id_barang', $p->id_barang)
                ->delete();
        } elseif ($baru > $p->stok) {
            return back()->with('gagal', 'Jumlah melebihi stok tersedia.');
        } else {
            DB::table('keranjang')
                ->where('id_user', auth()->id())
                ->where('id_barang', $p->id_barang)
                ->update(['jumlah' => $baru]);
        }

        return redirect('/keranjang');
    }

    public function hapus($id)
    {
        DB::table('keranjang')
            ->where('id_user', auth()->id())
            ->where('id_barang', $id)
            ->delete();

        return redirect('/keranjang');
    }

    public function kosongkan()
    {
        DB::table('keranjang')->where('id_user', auth()->id())->delete();
        return redirect('/keranjang');
    }
}