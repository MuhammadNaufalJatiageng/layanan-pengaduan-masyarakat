<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'nik' => '12345678901112',
            'role' => 'Admin',
            'alamat' => 'Kelurahan',
            'password' => bcrypt('password'),
        ]);

        User::factory(5)->create();

        Kategori::create([
            'nama' => 'Lingkungan'
        ]);
        Kategori::create([
            'nama' => 'Keamanan'
        ]);
        Kategori::create([
            'nama' => 'Kemasyarakatan'
        ]);

        Pengaduan::factory(6)->create();
    }
}
