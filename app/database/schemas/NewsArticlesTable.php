<?php
namespace App\Database\Schemas;

/**
 * news artilces schema
 */
 use Illuminate\Database\Capsule\Manager as Capsule;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

 class NewsArticlesTable extends Migration
 {

     public function up()
     {
         Capsule::schema()->create('news_articles', function (Blueprint $table) {
             $table->increments('id');
             $table->string('title')->required()->index();
             $table->string('slug')->unique()->required()->index();
             $table->string('image')->nullable();
             $table->string('excerpt')->required();
             $table->text('copy')->required();
             $table->boolean('archived')->default(false);
 			 $table->boolean('status')->default(true);
 			 $table->dateTime('published_at')->nullable();
             $table->dateTime('display_until')->nullable();
             $table->timestamps();
         });
     }

     public function down()
     {
         Capsule::schema()->dropIfExists('news_articles');
     }

 }
