<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama_depan' => 'Brenda',
                'nama_belakang' => 'Leannon',
                'email' => 'test@example.com',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-01-01 00:00:00', // Adjust the date as needed
                'email_verified_at' => now(),
                'password' => Hash::make('yourpassword'), // Change to your preferred password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more user entries here
        ]);
    }
}
