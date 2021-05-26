<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $productRecords = [
        ['id'=>1, 'category_id'=>3,'section_id'=>1,'brand'=>'Asus','name'=>"Vivobook",'code'=>"C1",'price'=>'1','description'=>'Good computer','meta_title'=>'laptops','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1],
        ['id'=>2, 'category_id'=>2,'section_id'=>1,'brand'=>'Dell','name'=>"XPS 15",'code'=>"C2",'price'=>'2','description'=>'Very good computer','meta_title'=>'laptops','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1],
      ];

      Product::insert($productRecords);
    }
}
