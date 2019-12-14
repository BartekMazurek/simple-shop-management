<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'id' => 1,
            'name' => 'Opened',
        ]);

        DB::table('statuses')->insert([
            'id' => 2,
            'name' => 'Collecting',
        ]);

        DB::table('statuses')->insert([
            'id' => 3,
            'name' => 'Sent',
        ]);

        DB::table('statuses')->insert([
            'id' => 4,
            'name' => 'Finished',
        ]);
    }
}
