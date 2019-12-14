<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'PC Gaming Setup',
            'description' => 'G500 i5-9400F/ B360/ GTX1660/ 16GB RAM/ 256GB SSD M.2 PCIe/ 1TB HDD',
            'price' => 1999.99,
            'stock_units' => 800
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Playstation 4 Slim 1TB',
            'description' => 'Sony home entertainment system',
            'price' => 999.99,
            'stock_units' => 500
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'LG Gaming Monitor',
            'description' => '34GK950G-B 34 WQHD NanoIPS 5ms',
            'price' => 4000.00,
            'stock_units' => 1200
        ]);
    }
}
