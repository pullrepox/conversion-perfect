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
                'base_url'   => 'https://lightspeeddev.sendlane.com/api/v1/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'mailchimp',
                'base_url'   => 'https://us7.api.mailchimp.com/3.0/',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('responders')->insert($list);
    }
}
