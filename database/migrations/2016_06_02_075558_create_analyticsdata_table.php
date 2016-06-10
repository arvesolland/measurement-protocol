<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticsdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyticsdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id');
            $table->string('ref_id');
            $table->string('payment_method');
            $table->json('datalayer');
            $table->integer('status');
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
        Schema::drop('analyticsdatas');
    }
}
