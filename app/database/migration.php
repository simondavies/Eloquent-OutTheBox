<?php
require __DIR__ . '/../bootstrap.php';


class Migrations {
    /**
     * Add your migrations to the $migrations array
     *
     */
    protected $migrations = [
        NewsArticlesTable::class,
    ];


    function __construct(){
        echo "Running Migrations...\r\n" ;
        self::delete()->create();
    }

    /**
     * create all migrations
     */
    function create(){

        foreach ($this->migrations as $table) {
            (new $table())->up();
            echo "\033[32m" . $table . "\033[0m migrated...\r\n" ;
        }

        echo "All Migrations successfully created...\r\n" ;
    }
    /**
     * delete all migrations
     */
    function delete(){
        foreach ($this->migrations as $table) {
            (new $table)->down();
        }
        return $this;
    }

}

/**
 * Auto run the migrations when called.
 */
new Migrations();
