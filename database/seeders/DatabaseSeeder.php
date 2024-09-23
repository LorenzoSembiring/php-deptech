<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    DB::table('users')->insert([
        [
            'nama_depan' => 'Brenda',
            'nama_belakang' => 'Leannon',
            'email' => 'test@example.com',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '1990-01-01 00:00:00',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}
}
