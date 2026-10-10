<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = DB::table('orders')
            ->where('id_user', auth()->id())
            ->orderByDesc('tanggal_order')
            ->get();

        return view('pesanan', compact('orders'));
    }

    public function show($id)
    {
        $order = DB::table('orders')
            ->where('id_order', $id)
            ->where('id_user', auth()->id())   
            ->first();

        abort_if(!$order, 404);

        $details = DB::table('order_details')
            ->join('products', 'products.id_barang', '=', 'order_details.id_barang')
            ->where('order_details.id_order', $id)
            ->select('products.nama_barang', 'order_details.harga_satuan', 'order_details.jumlah_beli')
            ->get();

        return view('pesanan_detail', compact('order', 'details'));
    }
}