<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recommendation_id')->unsigned();
            $table->string('name');
            $table->integer('movie_id');
            $table->date('year');
            $table->text('overview');
            $table->string('poster');
            $table->string('backdrop');
            $table->string('trailer')->nullable();
            $table->text('commentary')->nullable();
            $table->timestamps();
            $table->foreign('recommendation_id')->references('id')->on('recommendations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendation_items');
    }
}
