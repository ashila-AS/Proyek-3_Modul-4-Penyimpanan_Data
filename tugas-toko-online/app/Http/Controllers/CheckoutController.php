<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => ['required', 'string', 'max:500'],
        ]);

        $idUser = auth()->id();

        try {
            $idOrder = DB::transaction(function () use ($request, $idUser) {
                $items = DB::table('keranjang')->where('id_user', $idUser)->get();

                if ($items->isEmpty()) {
                    throw new \RuntimeException('Keranjang masih kosong.');
                }

               $products = DB::table('products')
                    ->whereIn('id_barang', $items->pluck('id_barang'))
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id_barang');

                $total = 0;
                foreach ($items as $item) {
                    $p = $products[$item->id_barang] ?? null;
                    if (!$p || $item->jumlah > $p->stok) {
                        throw new \RuntimeException('Stok "' . ($p->nama_barang ?? $item->id_barang) . '" tidak mencukupi.');
                    }
                    $total += $p->harga * $item->jumlah;
                }

                $waktu = now();
                $idOrder = 'ORD' . $waktu->format('ymdHis');
                while (DB::table('orders')->where('id_order', $idOrder)->exists()) {
                    $waktu = $waktu->addSecond();
                    $idOrder = 'ORD' . $waktu->format('ymdHis');
                }

                DB::table('orders')->insert([
                    'id_order' => $idOrder,
                    'id_user' => $idUser,
                    'tanggal_order' => now(),
                    'total_harga' => $total,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                ]);

                foreach ($items as $item) {
                    $p = $products[$item->id_barang];

                    DB::table('order_details')->insert([
                        'id_order' => $idOrder,
                        'id_barang' => $item->id_barang,
                        'harga_satuan' => $p->harga,      
                        'jumlah_beli' => $item->jumlah,
                    ]);

                    DB::table('products')
                        ->where('id_barang', $item->id_barang)
                        ->decrement('stok', $item->jumlah);
                }

                DB::table('keranjang')->where('id_user', $idUser)->delete();

                return $idOrder;
            });
        } catch (\RuntimeException $e) {
            return redirect('/keranjang')->with('gagal', $e->getMessage());
        }

        return redirect('/pesanan/' . $idOrder)->with('sukses', 'Checkout berhasil. Nomor pesanan: ' . $idOrder);
    }
}