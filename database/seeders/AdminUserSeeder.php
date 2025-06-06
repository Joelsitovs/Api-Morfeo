<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'alanjoelt43@gmail.com'],
            [
                'name' => 'Joel Admin',
                'password' => bcrypt('admin1234'),
            ]
        );

        $user->assignRole('admin');
    }
}
