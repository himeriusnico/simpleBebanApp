<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBeban;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::create([
        'name'     => 'Admin User',
        'email'    => 'admin@beban.test',
        'password' => bcrypt('password'),
        'role'     => 'admin',
    ]);

    User::create([
        'name'     => 'Staff User',
        'email'    => 'staff@beban.test',
        'password' => bcrypt('password'),
        'role'     => 'staff',
    ]);

    KategoriBeban::create(['nama_kategori' => 'Operasional']);
    KategoriBeban::create(['nama_kategori' => 'Gaji']);
    KategoriBeban::create(['nama_kategori' => 'Pemasaran']);
    }
}
