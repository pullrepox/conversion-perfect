<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpgradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('upgrades')->truncate();
        
        $list = [
            [
                'alias'          => 'access',
                'description'    => 'Access',
                'jvzooid'        => '332178,332176,332174',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'standard',
                'description'    => 'Upgrade to Standard',
                'jvzooid'        => '332176',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'social-unlimited',
                'description'    => 'Upgrade to Social Unlimited',
                'jvzooid'        => '332178',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'professional',
                'description'    => 'Professional',
                'jvzooid'        => '332182',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '18,19',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'lead-capture',
                'description'    => 'Lead Capture',
                'jvzooid'        => '332180',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '17',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'agency',
                'description'    => 'Agency',
                'jvzooid'        => '',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '22,23',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'templates',
                'description'    => 'Templates',
                'jvzooid'        => '',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '20,21',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'alias'          => 'reseller',
                'description'    => 'Reseller',
                'jvzooid'        => '332186,332188,332190',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];
        
        DB::table('upgrades')->insert($list);
    }
}
