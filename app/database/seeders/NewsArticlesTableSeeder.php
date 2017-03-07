<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;
use Faker\Factory;

class NewsArticlesTableSeeder extends Seeder
{
    /**
     * @var Faker\Factory
     */
    protected $faker;
    /**
     * @var Integer
     */
    protected $total_articles;

    /**
     *
     * @param Integer $total_articles
     */
    function __construct($total_articles = 20){

        $this->faker = Factory::create();

        $this->total_articles = $total_articles;
    }

    public function run()
    {
        //-- clear content on initalisation
        Capsule::table('news_articles')->delete();
        //-- reset the auto increment on initalisation
        Capsule::statement("ALTER TABLE news_articles AUTO_INCREMENT = 1");

        for ($article=0; $article < $this->total_articles; $article++) {

            $article_title = $this->faker->sentence;
            $archived = $this->faker->boolean;
            $status = ($archived) ? 1 : $this->faker->boolean;

            $date = $this->faker->dateTimeBetween('-1 month', '+2 weeks');

            Capsule::table('news_articles')->insert([
                    'title' => $article_title,
                    'slug' => str_slug($article_title),
                    'image' => $this->faker->imageUrl,
                    'excerpt' => $this->faker->text(80),
                    'copy' => $this->faker->text(200),
                    'archived' => $archived,
                    'status' => $status,
                    'published_at' => $date,
                    'display_until' => $this->faker->dateTimeBetween('+2 months', '+5 months'),
                    'created_at' => $date
            ]);
        }

    }

}
