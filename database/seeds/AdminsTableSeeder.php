<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
                        ['id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'9809090','email'=>'a@a.com','password'=>'$2y$10$iAPbSiInJh.DOlGY9y4Kl.kQOR7XVp5eywQql5CKKAckdqOSoOuB6', 'image'=>'', 'status'=>1],
                        ];
        DB::table('admins')->insert($adminRecords);

        //   foreach ($adminRecords as $key => $record) {
        //     \App\Admin::create($record);
        // }
    }
}
