<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'id_user' => 'USR001', 'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com', 'username' => 'budi',
            'password' => 'rahasia123', 'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1, Bandung',
        ]);

        User::create([
            'id_user' => 'USR002', 'nama_lengkap' => 'Siti Aminah',
            'email' => 'siti@example.com', 'username' => 'siti',
            'password' => 'rahasia456', 'no_hp' => '081298765432',
            'alamat' => 'Jl. Sudirman No. 2, Jakarta',
        ]);

        $barang = [
            ['BRG001', 'Buku Tulis', 5000, 50, 'buku-tulis.jpg'],
            ['BRG002', 'Pulpen', 3000, 100, 'pulpen.jpg'],
            ['BRG003', 'Penggaris', 4000, 40, 'penggaris.jpg'],
            ['BRG004', 'Pensil 2B', 2500, 80, 'pensil.jpg'],
            ['BRG005', 'Penghapus', 1500, 60, 'penghapus.jpg'],
            ['BRG006', 'Spidol', 7000, 30, 'spidol.jpg'],
            ['BRG007', 'Stabilo', 8000, 25, 'stabilo.jpg'],
            ['BRG008', 'Tip X', 2000, 70, 'tip-x.jpg'],
            ['BRG009', 'Lem Kertas', 4500, 0, 'lem.jpg'],   // stok 0 untuk uji
            ['BRG010', 'Gunting', 9000, 20, 'gunting.jpg'],
        ];

        foreach ($barang as [$id, $nama, $harga, $stok, $gambar]) {
            Product::create([
                'id_barang' => $id,
                'nama_barang' => $nama,
                'deskripsi' => 'Alat tulis ' . strtolower($nama),
                'harga' => $harga,
                'stok' => $stok,
                'gambar' => $gambar,
            ]);
        }
    }
}