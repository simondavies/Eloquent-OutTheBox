<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use Faker\Factory;
use Carbon\Carbon;
use App\Models\NewsArticle;
use App\Database\Seeders\NewsArticlesTableSeeder;

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
            'display_until' => $this->date->subMonth(1),
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

        $total_artilces_to_create = 10;
        self::createNewsArtilces($total_artilces_to_create);

        $articles = $this->articles->all();

        $this->assertCount($total_artilces_to_create, $articles);

    }

    /** @test */
    function get_a_list_of_all_active_articles(){

        $articles = $this->articles->active();
        $date = Carbon::now()->getTimestamp();

        if($articles->count() > 0){
            foreach ($articles as $key => $article) {
                $this->assertTrue($article->status);
                $this->assertFalse($article->archived);
                $this->assertLessThanOrEqual($date, $article->published_at->getTimestamp());
                $this->assertGreaterThanOrEqual($date, $article->display_until->getTimestamp());
            }
        } else {
            $this->assertEmpty($articles);
        }

    }

    /** @test */
    function check_the_active_articles_ordering_is_by_published_date_asc(){

        $articles = $this->articles->active();

        if($articles->count() > 0){
            self::checkDatesAreGreaterThan($articles);
        } else {
            $this->assertEmpty($articles);
        }

    }


    /** @test */
    function get_a_list_of_all_archived_articles(){

        $articles = $this->articles->archived();
        $date = Carbon::now()->getTimestamp();

        if($articles->count() > 0){
            foreach ($articles as $key => $article) {
                $this->assertTrue($article->status);
                $this->assertTrue($article->archived);
                $this->assertLessThanOrEqual($date, $article->published_at->getTimestamp());
                $this->assertGreaterThanOrEqual($date, $article->display_until->getTimestamp());
            }
        } else {
            $this->assertEmpty($articles);
        }

    }

    /** @test */
    function check_the_archived_articles_ordering_is_by_published_date_asc(){

        $articles = $this->articles->archived();

        if($articles->count() > 0){
            self::checkDatesAreGreaterThan($articles);
        } else {
            $this->assertEmpty($articles);
        }

    }

    /** @test */
    function get_a_list_of_all_scheduled_articles(){

        $articles = $this->articles->scheduled();
        $date = Carbon::now()->getTimestamp();

        if($articles->count() > 0){
            foreach ($articles as $key => $article) {
                $this->assertTrue($article->status);
                $this->assertFalse($article->archived);
                $this->assertGreaterThan($date, $article->published_at->getTimestamp());
                $this->assertGreaterThan($article->published_at->getTimestamp(), $article->display_until->getTimestamp());
            }
        } else {
            $this->assertEmpty($articles);
        }

    }

    /** @test */
    function check_the_scheduled_articles_ordering_is_by_published_date_desc(){

        $articles = $this->articles->scheduled();
        if($articles->count() > 0){
            self::checkDatesAreLessThan($articles);
        } else {
            $this->assertEmpty($articles);
        }

    }

    /**
     * create a total number of dummy news articles
     * @param  Integer $total
     * @return Void
     */
    function createNewsArtilces($total){

        $article_Seeder = new NewsArticlesTableSeeder($total);
        $article_Seeder->run();

    }

    function checkDatesAreGreaterThan($artilces){
        $current = NULL;
        $previous = NULL;

        foreach ($artilces as $key => $article) {
            $current = $article->published_at->getTimestamp();
            $this->assertGreaterThan($previous,$current);
            $previous = $current;
        }

    }

    function checkDatesAreLessThan($artilces){

        $current = NULL;
        $previous = Carbon::now()->getTimestamp();

        foreach ($artilces as $key => $article) {
            $current = $article->published_at->getTimestamp();
            $this->assertLessThan($current, $previous);
            $previous = $current;
        }

    }




}
