<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed user admin utama
     */
    public function run(): void
    {
        // Admin Utama (Email: admin@localhost, Password: admin123)
        if (!User::where('email', 'admin@localhost')->exists()) {
            User::create([
                'name' => 'Administrator Utama',
                'email' => 'admin@localhost',
                'password' => bcrypt('admin123'),
                'daerah_id' => null,
                'is_approved' => true,
                'is_main_admin' => true,
                'is_rejected' => false,
            ]);
            $this->command->info('✅ Admin Utama (admin@localhost) berhasil dibuat!');
        } else {
            $this->command->warn('⚠️  Admin Utama (admin@localhost) sudah ada.');
        }

        // Admin Secondary (Email: admin@gmail.com, Password: password)
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin Secondary',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'daerah_id' => null,
                'is_approved' => true,
                'is_main_admin' => true,
                'is_rejected' => false,
            ]);
            $this->command->info('✅ Admin Secondary (admin@gmail.com) berhasil dibuat!');
        } else {
            $this->command->warn('⚠️  Admin Secondary (admin@gmail.com) sudah ada.');
        }

        // Test User (Email: test@example.com, Password: password)
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'daerah_id' => null,
                'is_approved' => true,
                'is_main_admin' => false,
                'is_rejected' => false,
            ]);
            $this->command->info('✅ Test User (test@example.com) berhasil dibuat!');
        } else {
            $this->command->warn('⚠️  Test User (test@example.com) sudah ada.');
        }
    }
}
