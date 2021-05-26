<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categoryRecords = [
        ['id'=>1, 'parent_id'=>'0','section_id'=>1,'category_name'=>'Laptops','category_image'=>"",'category_discount'=>'0','description'=>'','url'=>'laptops','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','status'=>1],
        ['id'=>2, 'parent_id'=>'1','section_id'=>1,'category_name'=>'Gaming Laptops','category_image'=>"",'category_discount'=>'0','description'=>'','url'=>'gaming-laptops','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','status'=>1],
        ['id'=>3, 'parent_id'=>'1','section_id'=>1,'category_name'=>'Work Laptops','category_image'=>"",'category_discount'=>'0','description'=>'','url'=>'work-laptops','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','status'=>1],
      ];

      Category::insert($categoryRecords);
    }
}
