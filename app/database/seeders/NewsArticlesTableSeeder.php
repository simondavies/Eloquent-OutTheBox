<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

class NewsArticlesTableSeeder extends Seeder
{

    public function run()
    {
        //-- clear content on initalisation
        Capsule::table('news_articles')->delete();
        //-- reset the auto increment on initalisation
        Capsule::statement("ALTER TABLE news_articles AUTO_INCREMENT = 1");

        $date = Carbon::now();

        Capsule::table('news_articles')->insert([
            [
                'title' => '',
                'slug' => str_slug(''),
                'image' => '',
                'excerpt' => '',
                'copy' => '',
                'archived' => false,
                'status' => true,
                'published_at' => $date->addMonths(1),
                'dsiplay_until' => $date->addMonths(1),
                'created_at' => $date->addMonths(1)
            ]
        ]);

    }

}
