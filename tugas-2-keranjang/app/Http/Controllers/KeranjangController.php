<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{

    private function ambil(): array
    {
        return session('keranjang', []);
    }

    public function index()
    {
        $barang = Barang::all();
        $jumlahItem = array_sum($this->ambil());
        return view('index', compact('barang', 'jumlahItem'));
    }

    public function keranjang()
    {
        $cart = $this->ambil();
        $barang = Barang::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = [];
        $total = 0;
        foreach ($cart as $id => $jumlah) {
            if (!isset($barang[$id])) {
                continue;
            }
            $b = $barang[$id];
            $subtotal = $b->harga * $jumlah;
            $total += $subtotal;
            $items[] = ['barang' => $b, 'jumlah' => $jumlah, 'subtotal' => $subtotal];
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function tambah($id)
    {
        $b = Barang::findOrFail($id);
        $cart = $this->ambil();
        $jumlah = ($cart[$b->id] ?? 0) + 1;

        if ($jumlah > $b->stok) {
            return back()->with('pesan', 'Stok tidak mencukupi.');
        }

        $cart[$b->id] = $jumlah;
        session(['keranjang' => $cart]);
        return back();
    }

    public function ubah(Request $request, $id)
    {
        $b = Barang::findOrFail($id);
        $cart = $this->ambil();

        if (!isset($cart[$b->id])) {
            return redirect('/keranjang');
        }

        $jumlah = $cart[$b->id] + ($request->aksi === 'tambah' ? 1 : -1);

        if ($jumlah <= 0) {
            unset($cart[$b->id]);          
        } elseif ($jumlah > $b->stok) {
            return back()->with('pesan', 'Stok tidak mencukupi.');
        } else {
            $cart[$b->id] = $jumlah;
        }

        session(['keranjang' => $cart]);
        return redirect('/keranjang');
    }

    public function hapus($id)
    {
        $cart = $this->ambil();
        unset($cart[(int) $id]);
        session(['keranjang' => $cart]);
        return redirect('/keranjang');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect('/keranjang');
    }
}