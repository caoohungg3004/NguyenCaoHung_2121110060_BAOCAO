<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=10;$i++){
            Order::insert([
                'user_id' => 06,
                'name' =>  'order',
                'email' => 'hưng',
                'phone' => '0866190841',
                'address' => 'phuoclongb',
                'note' => 'cẩn thận',
                'created_by' => 1,
                'updated_by' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
