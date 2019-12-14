<?php

use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'id' => 1,
            'group_id' => 2,
            'name' => 'ABC Company Inc.',
            'email' => 'abc@mail.com',
            'address' => '8989 Griffin St.Prattville, AL 36067',
            'description' => 'Business type: retail, customer goods'
        ]);

        DB::table('clients')->insert([
            'id' => 2,
            'group_id' => 1,
            'name' => 'ZYX Corporation LLC',
            'email' => 'zyx@mail.com',
            'address' => '7142 Blue Spring Rd.Los Banos, CA 93635',
            'description' => 'Business type: online retail, marketing'
        ]);

        DB::table('clients')->insert([
            'id' => 3,
            'group_id' => 3,
            'name' => 'John Smith',
            'email' => 'john.smith@mail.com',
            'address' => '35 East Lafayette Ave.New Port Richey, FL 34653',
            'description' => ''
        ]);

        DB::table('clients')->insert([
            'id' => 4,
            'group_id' => 3,
            'name' => 'Henry Ford',
            'email' => 'hford@mail.com',
            'address' => '8108 Pine Street Orlando, FL 32806',
            'description' => ''
        ]);
    }
}
