<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mvp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('name');
            $table->string('type');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->text('dev_tools');
            $table->string('how_to_use_file'); 
            $table->string('mvp_file');
            $table->integer('price');
            $table->string('image_one');
            $table->string('image_two');
            $table->string('image_three');
            $table->integer('is_approved')->unsigned()->default(0);
            $table->integer('is_available')->unsigned()->default(1);
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
        Schema::dropIfExists('mvp');
    }
}
