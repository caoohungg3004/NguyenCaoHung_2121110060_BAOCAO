<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=10;$i++){
            Brand::insert([
                'name' =>  'brand '.$i,
                'image' =>  'hinhanh.jpg',
                'slug' => 'hùng',
                'sort_order' => 1,
                'metakey' => 'acaca',
                'metadesc' => 'acac',
                'created_by' => 1,
                'updated_by' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
