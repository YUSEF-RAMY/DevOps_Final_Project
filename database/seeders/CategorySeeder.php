<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'كاميرات', 'description' => 'اعلي دقه', 'imagepath' => 'assets/img/category/camera_1.jpeg'],
            ['name' => 'خضار', 'description' => 'اجود انواع الخضار', 'imagepath' => 'assets/img/category/خضار.jpeg'],
            ['name' => 'ورد', 'description' => 'اجود العطور', 'imagepath' => 'assets/img/category/flawer.jpeg'],
            ['name' => 'فواكه', 'description' => 'الفواكه سر السعاده', 'imagepath' => 'assets/img/category/fruits.jpeg'],
            ['name' => 'الماكولات', 'description' => 'اجود الماكولات', 'imagepath' => 'assets/img/category/اكل.jpeg'],
            ['name' => 'مستحضارات التجميل', 'description' => 'احدث الاجهزة التجميلية', 'imagepath' => 'assets/img/category/makeup.jpeg'],
        ]);
    }
}
