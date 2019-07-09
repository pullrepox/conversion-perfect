<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bonuses')->truncate();
    
        $list = [
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'Continuity Income',
                'description'      => 'If you need financial freedom, then you need the Continuity Income Program. Our outstanding 52-part course shows you how to build your business to generate con..',
                'image_url'        => 'https://lifetime.hosting/wso/wp-content/uploads/2016/06/cip.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/033-continuityincome.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'Surefire Buyer Intelligence',
                'description'      => 'This 8-part video course is designed to show you how you can get attract the perfect buyer who wants to buy all your products and services. Finally, Discover H...',
                'image_url'        => 'https://lifetime.hosting/wso/wp-content/uploads/2016/06/sbi.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/023-surefirebuyerintelligence.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'Lead Generation Mastery',
                'description'      => 'Discover The Step-By-Step System To Create Massive Leads From Scratch, And Start Generating Insane Profits - Even If You\'re A Complete Newbie! What Is this \"Le...',
                'image_url'        => 'https://lifetime.hosting/wso/wp-content/uploads/2016/06/lgm.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/020-leadgenerationmastery.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'The Organized Mind Gold',
                'description'      => 'There\'s a long way and a short way. The long way? Trying to figure out everything yourself, only to go around in circles. All that time wasted could have been ...',
                'image_url'        => 'https://lifetime.hosting/wso/wp-content/uploads/2016/06/tom.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/005-theorganizedmindgold.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'Social Media Income',
                'description'      => 'Learn everything you need to know about generating income through social media. This whopping 36-part Video Series covers Facebook, Instagram, LinkedIn, Pintere...',
                'image_url'        => 'http://lifetime.hosting/two/preview/images/smibundle.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/03-socialmediaincome.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => 'High Ticket Authority',
                'description'      => 'Are you tired of making measly $7, $10 and $20 sales? You drive so much traffic only to make such a small amount. In This Course, You\'ll Find Out How To Make a...',
                'image_url'        => 'https://lifetime.hosting/wso/wp-content/uploads/2016/06/hta.png',
                'bonus_url'        => 'https://bonuses.lifetime.hosting/downloads/024-highticketauthority.zip',
                'link_text'        => 'Get This!',
                'new_window'       => '0',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'plans'            => '1,14,15,16,17,18,19,20,21,22,23',
                'title'            => '10,000 Royalty-Free Stock Photos',
                'description'      => 'Every website and online project needs high quality images. Instead of paying between $1 and $16 per image, we\'ve worked out a licensing deal with our multiple...',
                'image_url'        => 'http://lifetime.hosting/two/preview/images/royaltyfree.jpg',
                'bonus_url'        => 'http://bonuses.lifetime.hosting/10000/',
                'link_text'        => 'Get This!',
                'new_window'       => '1',
                'background_color' => '#fff3cc',
                'image_padding'    => '24',
                'sort_order'       => 10,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]
        ];
    
        DB::table('bonuses')->insert($list);
    }
}
