<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat role siswa
        Role::firstOrCreate(['name' => 'siswa']);

        // Buat user dan assign role siswa
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '1234567890',
            'nisn' => '1234567890'
        ]);

        $user->assignRole('siswa');
    }
}
