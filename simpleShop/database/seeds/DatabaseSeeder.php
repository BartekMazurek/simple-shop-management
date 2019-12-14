<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientGroupsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(StatusesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderDetailsSeeder::class);
    }
}
