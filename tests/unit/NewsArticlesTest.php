<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use Faker\Factory;
use Carbon\Carbon;
use App\Models\NewsArticle;

class NewsArticlesTest extends TestCase
{

    public function setUp(){

        $this->faker = Factory::create();
        $this->articles = new NewsArticle();
        $this->date = Carbon::now();

        $this->title = 'Welcome to the news article';

    }

    public function tearDwon(){

        unset($this->articles);


    }

    /** @test */
    function create_a_news_article()
    {
        //-- clear content on initalisation
        Capsule::table('news_articles')->delete();
        //-- reset the auto increment on initalisation
        Capsule::statement("ALTER TABLE news_articles AUTO_INCREMENT = 1");

        $result = $this->articles->create([
            'title' => $this->title,
            'slug' => str_slug($this->title),
            'image' => $this->faker->imageUrl,
            'excerpt' => $this->faker->text(80),
            'copy' => $this->faker->text(200),
            'archived' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'published_at' => $this->date->subMonth(1),
            'dsiplay_until' => $this->date->subMonth(1),
            'created_at' => $this->date->subMonth(1)
        ]);

        $this->assertEquals($result->id, 1);

    }

    /** @test */
    function get_a_news_article()
    {
        $article = $this->articles->find(1);

        $artilce_title = $this->title;

        $this->assertEquals($article->title, $artilce_title);
    }

    /** @test */
    function add_several_article_to_test_seeder(){

        //-- call the seeder and check the total of entries

    }

    /** @test */
    function get_a_list_of_all_active_articles(){

        //-- list all articles where the:
        //-- status - true
        //-- published_at - is after the now date
        //-- display_until - is before the now date

    }


    /** @test */
    function get_a_list_of_all_archived_articles(){

        //-- list all archive artilces
        //-- archived - true
        //-- published_at - is after the now date
        //-- display_until - is before the now date

    }


    /** @test */
    function get_a_list_of_all_scheduled_articles(){

        //-- list all articles that are shceduled to be published
        //-- status - true
        //-- published_at - is after the now date
        //-- display_until - is before the now date

    }




}
