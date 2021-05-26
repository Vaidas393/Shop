<?php

use Illuminate\Database\Seeder;
use App\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
          ['id'=>1, 'name'=>'Computers','status'=>1],
          ['id'=>2, 'name'=>'Headphones','status'=>1],
          ['id'=>3, 'name'=>'Mobile phones','status'=>1],
        ];

        Section::insert($sectionsRecords);
    }
}
