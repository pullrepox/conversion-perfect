<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        
        $list = [
            [
                'description'         => 'access',
                'am_plans'            => '14,15,16',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'split-test',
                'am_plans'            => '18,19',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'multi-bar',
                'am_plans'            => '18,19',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'remove-powered-by',
                'am_plans'            => '18,19,22,23',
                'am_upgrade_required' => 3,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'social-buttons',
                'am_plans'            => '14',
                'am_upgrade_required' => 2,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'lead-capture',
                'am_plans'            => '17',
                'am_upgrade_required' => 4,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'agency',
                'am_plans'            => '22,23',
                'am_upgrade_required' => 5,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'pro-templates',
                'am_plans'            => '18',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => '120-templates',
                'am_plans'            => '21',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => '240-templates',
                'am_plans'            => '20',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'reseller',
                'am_plans'            => '25,26,27',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 0,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '14',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 3,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '15',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => 50,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'description'         => 'maximum-bars',
                'am_plans'            => '16,22,23',
                'am_upgrade_required' => 0,
                'am_maximum_bars'     => (-1),
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ];
        
        DB::table('permissions')->insert($list);
    }
}
