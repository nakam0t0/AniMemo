<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image_path')->nullable();
            $table->string('title_short1')->nullable();
            $table->string('title_short2')->nullable();
            $table->string('title_short3')->nullable();
            $table->integer('year');
            $table->integer('cours');
            $table->string('public_url');
            $table->string('twitter_account');
            $table->string('twitter_hash_tag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
