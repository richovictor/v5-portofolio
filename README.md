        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => '1234567890',
            'nisn' => '1234567890'
        ]);

        $user->assignRole('siswa');

        $admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => '#adminportoV',
            'nisn' => '1234567891'
        ]);
