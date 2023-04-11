<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'krishna',
            'email' => 'krishna@gmail.com',
            'password' => Hash::make('krishna@123'),
            'mobile_no' => '5435521564',
            'birth_date' => '2000/01/01'
        ]);

        $user->assignRole('user');
    }
}
