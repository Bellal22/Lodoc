<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Maps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Latitude');
            $table->integer('Longitude');
            $table->integer('Doc_id');
            $table->integer('Hos_id');

            $table->timestamps();
            $table->foreign('Doc_id')->references('doctors_id')->on('doctors')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('Hos_id')->references('hospital_id')->on('hospital')
                ->onUpdate('cascade')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maps');
    }
}
