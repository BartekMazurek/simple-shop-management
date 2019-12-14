<?php

use Illuminate\Database\Seeder;

class ClientGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_groups')->insert([
            'id' => 1,
            'name' => 'Corporate customer',
        ]);

        DB::table('client_groups')->insert([
            'id' => 2,
            'name' => 'Business customer'
        ]);

        DB::table('client_groups')->insert([
            'id' => 3,
            'name' => 'Individual customer'
        ]);
    }
}
