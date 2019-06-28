<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->timestamps();
        });

        Schema::create('hash_tag_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hash_tag_id')->unsigned();
            $table->integer('work_id')->unsigned();
            $table->timestamps();

            $table->foreign('hash_tag_id')->references('id')->on('hash_tags');
            $table->foreign('work_id')->references('id')->on('works');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hash_tag_works');
        Schema::drop('hash_tags');
    }
}
