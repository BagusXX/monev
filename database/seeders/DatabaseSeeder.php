<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // default test user
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // create main admin if not exists
        if (!User::where('is_main_admin', true)->exists()) {
            User::factory()->create([
                'name' => 'Admin Utama',
                'email' => 'admin@localhost',
                'password' => bcrypt('password'),
                'daerah_id' => null,
                'is_approved' => true,
                'is_main_admin' => true,
            ]);
        }

        // ensure a specific admin email exists and is main admin
        $email = 'admin@gmail.com';
        $u = User::where('email', $email)->first();
        if ($u) {
            $u->update([
                'is_approved' => true,
                'is_main_admin' => true,
                'daerah_id' => null,
            ]);
        } else {
            User::factory()->create([
                'name' => 'Admin Gmail',
                'email' => $email,
                'password' => bcrypt('password'),
                'daerah_id' => null,
                'is_approved' => true,
                'is_main_admin' => true,
            ]);
        }
    }
}
