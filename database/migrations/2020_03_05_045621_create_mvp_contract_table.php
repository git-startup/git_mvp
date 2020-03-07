<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMvpContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mvp_contract', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mvp_id')->unsigned()->nullable();
            $table->foreign('mvp_id')
                ->references('id')
                ->on('mvp');
            $table->integer('developer_id');
            $table->integer('client_id');
            $table->integer('client_signature');
            $table->integer('developer_signature');
            $table->longText('agreement');
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
        Schema::dropIfExists('mvp_contract');
    }
}
