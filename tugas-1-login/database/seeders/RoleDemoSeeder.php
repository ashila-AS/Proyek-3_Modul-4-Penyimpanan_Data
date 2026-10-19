<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['admin1',    'Admin Utama',   'admin'],
            ['staff1',    'Staff Gudang',  'staff'],
            ['customer1', 'Customer Satu', 'customer'],
            ['customer2', 'Customer Dua',  'customer'],
        ];

        foreach ($accounts as [$username, $namaLengkap, $role]) {
            $user = User::firstOrNew(['username' => $username]);
            $user->nama_lengkap = $namaLengkap;
            $user->password     = 'password123'; 
            $user->role         = $role;        
            $user->save();
        }
    }
}