<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            User::insert([
                'name' =>  'user ' . $i,
                'email' => 'caoohungg3004@gmail.com',
                'phone' => '001122',
                'username' => 'caohung',
                'password' => 'hung',
                'address' => 'ht',
                'image' => 'hinhanh',
                'roles' => 12,
                'created_by' => 1,
                'updated_by' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
