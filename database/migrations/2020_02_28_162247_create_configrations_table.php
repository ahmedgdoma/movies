<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('config_name', 255);
            $table->bigInteger('config_value')->nullable();
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::table('configrations')->insert([
           ['config_name'=> 'number_of_top_rated', 'config_value'=> 100],
            ['config_name'=> 'number_of_recent', 'config_value'=> 100],
            ['config_name'=> 'interval_timer', 'config_value'=>10],
            ['config_name'=> 'last_queue_run', 'config_value'=>0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configrations');
    }
}
