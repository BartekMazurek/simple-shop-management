<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'client_id' => 1,
            'status_id' => 4,
            'created_at' => '2019-10-20 09:00:00',
            'modified_at' => '2019-10-20 09:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 2,
            'status_id' => 3,
            'created_at' => '2019-11-15 12:00:00',
            'modified_at' => '2019-11-15 12:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 3,
            'status_id' => 2,
            'created_at' => '2019-11-30 15:00:00',
            'modified_at' => '2019-11-30 15:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 1,
            'status_id' => 1,
            'created_at' => '2019-12-10 09:00:00',
            'modified_at' => '2019-12-10 09:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 4,
            'status_id' => 4,
            'created_at' => '2019-03-20 06:00:00',
            'modified_at' => '2019-03-20 06:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 4,
            'status_id' => 4,
            'created_at' => '2019-06-20 11:00:00',
            'modified_at' => '2019-06-20 11:00:00'
        ]);

        DB::table('orders')->insert([
            'client_id' => 4,
            'status_id' => 3,
            'created_at' => '2019-12-01 16:00:00',
            'modified_at' => '2019-12-01 16:00:00'
        ]);
    }
}
