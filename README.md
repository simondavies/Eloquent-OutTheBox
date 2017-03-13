## Eloquent-OutTheBox

---

Please note that this package is under current development and i need to complete the read me docs to make more sense.

---


A simple example of using Laravel's Eloquent outside of the Laravel framework, to utilise its awesome ORM power... and beyond!

I have  also included a simple migration and seeding set up as well, so that you can use similar methods to create your database schema(s) and temporary data.

BUT! I hear you say....

Yes! There are several out there, but i have created this mainly to aid my learning into PHP Testing and trying out my first TTD project. So it was something simple that i thought would be a great start.


### Installation

To be completed, need to submit it to packagist to enable composer, but for now you can simply download the zip or clone the repo.

I would like to complete the read me before I submit it.

### Migrations
I have created a migration set up, so you can easily create simple migrations that you are used to running in a Laravel project.

Copy the `app/database/schemas/ExampleTable.php` and rename, and don't forget to also rename the class name within, or use the following template as a starter.

```php

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

         });
     }

     public function down()
     {
         Capsule::schema()->dropIfExists('table_name');
     }

 }

 ```

Create your schema, as you would normally within a Laravel project.  Those not familiar, can view the [Laravel documentation](https://laravel.com/docs/5.4/migrations#migration-structure) for further details, not all is applicable but the Migration structure and majority of the documentation might apply.

Once you have created your migration schema's then open up the main migration file located at `app/database/migrations.php`. Add your migration classes to the end of the migrations array:

```php

    protected $migrations = [
        'App\Database\Schemas\NewsArticlesTable',
        'App\Database\Schemas\YOUR_MIGRATIONS_TABLE_CLASS',
    ];

```
Add a newline for each migration class.

##### Running migrations

Once you have created your migrations and updated the migrations file, using the terminal/command line `cd` into the database foler, and run the migrations file.

```

    cd app/database

    php migration.php

```

This should then run and display the migrations as they are created. That is if there are not issue, but php should let you know, if there is...


### Seeding



### Tests



#### To Do

* A simple php class to create a sample migration/seeder stub to help further


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
