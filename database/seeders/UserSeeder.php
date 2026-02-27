<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Diah Endang Ayu',
            'email' => 'diahendangayu@ikmi.ac.id',
            'password' => Hash::make('Password123!') // password yang bisa kamu pakai
        ]);
    }
}