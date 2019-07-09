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
                'title'      => 'Sendlane',
                'base_url'   => 'https://lightspeeddev.sendlane.com/api/v1/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Mailchimp',
                'base_url'   => 'https://us7.api.mailchimp.com/3.0/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Activecampaign',
                'base_url'   => 'https://account.api-us1.com/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Campaignmonitor',
                'base_url'   => 'https://api.createsend.com/api/v3.2/clients.json',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Getresponse',
                'base_url'   => 'https://api.getresponse.com/v3/accounts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Mailerlite',
                'base_url'   => 'https://api.mailerlite.com/api/v2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title'      => 'Sendinblue',
                'base_url'   => 'https://api.sendinblue.com/v3/account',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        
        DB::table('responders')->insert($list);
    }
}
