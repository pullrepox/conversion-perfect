<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'name' => 'bonuses',
                'slug' => 'bonuses',
                'title' => 'Bonus schemes',
                'content' => 'This is <b>bonus</b> page',
                'excerpt' => 'you will get exciting bonuses'
            ],
            [
                'name' => 'affiliates',
                'slug' => 'affiliates',
                'title' => 'Affiliates options',
                'content' => 'This is <b>Affiliates</b> page',
                'excerpt' => 'you will get awesome feature from affiliating'
            ]
        ];
        foreach ($pages as $page){
            $p = new \App\Models\Page($page);
            $p->save();
        }
    }
}
