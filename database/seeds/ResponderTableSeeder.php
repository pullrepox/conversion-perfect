<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ResponderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responders')->truncate();
        $list = [
            [
                'title'      => 'sendlane',
                'base_url'   => 'https://lightspeeddev.sendlane.com/api/v1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'aweber',
                'base_url'   => 'https://api.aweber.com/1.0/',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('responders')->insert($list);
    }
}
