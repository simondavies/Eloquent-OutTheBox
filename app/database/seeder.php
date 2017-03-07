<?php
 // boot database
 require __DIR__ . '/../bootstrap.php';

 /**
  *
  * Add your migrations to this array
  *
  */
 $seeders = [
      'App\Database\Seeders\NewsArticlesTableSeeder',
 ];

/**
 *
 * The Seeder files
 *  Add the seeder files to incluse here
 *
 */
 foreach ($seeders as $table) {
     (new $table())->run();
     echo "\033[32m" . $table . "\033[0m created...\r\n" ;
 }

 echo "All Seeders successfully run...\r\n" ;
