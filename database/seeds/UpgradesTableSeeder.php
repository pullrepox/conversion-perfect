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
                'description'    => 'Access',
                'jvzooid'        => '332178,332176,332174',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Upgrade to Standard',
                'jvzooid'        => '',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Upgrade to Social Unlimited',
                'jvzooid'        => '',
                'showwasupgrade' => 0,
                'unlessuserhas'  => '0',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Professional',
                'jvzooid'        => '332182',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '18,19',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Lead Capture',
                'jvzooid'        => '332180',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '17',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Agency',
                'jvzooid'        => '',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '22,23',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'description'    => 'Templates',
                'jvzooid'        => '',
                'showwasupgrade' => 1,
                'unlessuserhas'  => '20,21',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
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
