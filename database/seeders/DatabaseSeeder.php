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
        $this->command->info('🌱 Starting database seeding...');

        // Menggunakan updateOrCreate agar tidak error jika dijalankan ulang
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Kolom unik untuk dicek
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), 
            ]
        );
        \App\Models\Kategori::factory(5)->create();
        \App\Models\Rak::factory(10)->create();
        \App\Models\Buku::factory(50)->create();
        
        $this->command->info('🎉 Database seeding completed!');
    }
    
}
