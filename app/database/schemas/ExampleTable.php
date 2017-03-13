<?php
namespace App\Database\Schemas;

/**
 * example schema
 */
 use Illuminate\Database\Capsule\Manager as Capsule;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Database\Migrations\Migration;

 class ExampleTable extends Migration
 {

     public function up()
     {
         Capsule::schema()->create('table_name', function (Blueprint $table) {
             $table->increments('id');
             $table->string('title')->required()->index();
             $table->string('slug')->unique()->required()->index();
             $table->timestamps();
         });
     }

     public function down()
     {
         Capsule::schema()->dropIfExists('table_name');
     }

 }
