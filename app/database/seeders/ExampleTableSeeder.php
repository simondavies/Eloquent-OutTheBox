<?php

namespace App\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;
use Faker\Factory;

class ExampleTableSeeder extends Seeder
{
    /**
     * @var Faker\Factory
     */
    protected $faker;
    /**
     * @var Integer
     */
    protected $total_entries;

    /**
     *
     * @param Integer $total_entries
     */
    function __construct($total_entries = 20){

        $this->faker = Factory::create();

        $this->total_entries = $total_entries;
    }

    public function run()
    {
        //-- clear content on initalisation
        Capsule::table('table_name')->delete();
        //-- reset the auto increment on initalisation
        Capsule::statement("ALTER TABLE table_name AUTO_INCREMENT = 1");

        for ($entry=0; $entry < $this->total_entries; $entry++) {

            $entry_title = $this->faker->sentence;
            $status = ($archived) ? 1 : $this->faker->boolean;
            $date = $this->faker->dateTimeBetween('-1 month', '+2 weeks');

            Capsule::table('table_name')->insert([
                    'title' => $entry_title,
                    'slug' => str_slug($entry_title),
                    'created_at' => $date
            ]);
        }

    }

}
