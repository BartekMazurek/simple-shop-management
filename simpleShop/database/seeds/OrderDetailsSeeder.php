<?php

use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            'order_id' => 1,
            'product_id' => 1,
            'amount' => 20
        ]);

        DB::table('order_details')->insert([
            'order_id' => 1,
            'product_id' => 3,
            'amount' => 20
        ]);

        DB::table('order_details')->insert([
            'order_id' => 2,
            'product_id' => 3,
            'amount' => 50
        ]);

        DB::table('order_details')->insert([
            'order_id' => 3,
            'product_id' => 1,
            'amount' => 1
        ]);

        DB::table('order_details')->insert([
            'order_id' => 3,
            'product_id' => 2,
            'amount' => 1
        ]);

        DB::table('order_details')->insert([
            'order_id' => 3,
            'product_id' => 3,
            'amount' => 1
        ]);

        DB::table('order_details')->insert([
            'order_id' => 4,
            'product_id' => 2,
            'amount' => 2
        ]);

        DB::table('order_details')->insert([
            'order_id' => 5,
            'product_id' => 1,
            'amount' => 3
        ]);

        DB::table('order_details')->insert([
            'order_id' => 6,
            'product_id' => 2,
            'amount' => 2
        ]);

        DB::table('order_details')->insert([
            'order_id' => 7,
            'product_id' => 3,
            'amount' => 1
        ]);
    }
}
