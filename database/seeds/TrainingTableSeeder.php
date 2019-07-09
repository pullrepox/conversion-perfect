<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainings')->truncate();
        $list = [
            [
                'title'       => 'Introduction',
                'description' => 'Please be sure to checkout this introductory video. Please be sure to checkout this introductory video.',
                'video_url'   => 'https://player.vimeo.com/video/259994242',
                'sort_order'  => 10,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Getting Started',
                'description' => 'Need some information about your account?  This is the place.',
                'video_url'   => 'https://player.vimeo.com/video/259994323',
                'sort_order'  => 20,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'My Account',
                'description' => 'How do I Upgrade? How do I Upgrade? How do I Upgrade? How do I Upgrade? How do I Upgrade?',
                'video_url'   => 'https://player.vimeo.com/video/259994323',
                'sort_order'  => 30,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Tracking Links',
                'description' => 'What is a Tracking Link? Tracking Link Usaes? Function? More. What is a Tracking Link? Tracking Link Usaes? Function? More. What is a Tracking Link? Tracking Link Usaes? Function? More.',
                'video_url'   => 'https://player.vimeo.com/video/259994390',
                'sort_order'  => 40,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        ];
        
        DB::table('trainings')->insert($list);
    }
}
