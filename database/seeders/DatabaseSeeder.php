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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'siswa']);

        // Buat user dan assign role siswa
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => '1234567890',
            'nisn' => '1234567890',
            'email_verified_at' => now(),
        ]);

        $user->assignRole('siswa');

        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => '#adminportoV',
            'nisn' => '1234567891',
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');
    }
}
