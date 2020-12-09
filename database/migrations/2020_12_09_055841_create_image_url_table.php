<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;

class CreateImageUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb';
    public function up()
    {

        Schema::connection($this->connection)
        ->table('img_url', function (Blueprint $collection)
        {
          $collection->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::connection($this->connection)
      ->table('img_url', function (Blueprint $collection)
      {
          $collection->drop();
      });
    }
}
