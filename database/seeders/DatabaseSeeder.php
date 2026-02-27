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
        // Buat akun admin pertama
        User::factory()->create([
            'name'     => 'Admin N-Comics',
            'email'    => 'admin@ncomics.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        // Seed 10 komik dummy dengan episode
        $this->call(ComicSeeder::class);
    }
}
