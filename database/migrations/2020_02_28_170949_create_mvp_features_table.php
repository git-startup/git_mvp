<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvpFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mvp_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mvp_id')->unsigned()->nullable();
            $table->foreign('mvp_id')
                ->references('id')
                ->on('mvp');
            $table->string('name');
            $table->string('username')->nullable();
            $table->text('description');
            $table->string('url');
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
        Schema::dropIfExists('mvp_features');
    }
}
