<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('worker_id');
            $table->string('work_title');
            $table->date('start_of_agreement');
            $table->date('end_of_agreement');
            $table->integer('sallery');
            $table->integer('accepted')->unsigned()->default(0);
            $table->longText('agreement');
            $table->integer('is_deleted')->nullable();
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
        Schema::dropIfExists('work_list');
    }
}
