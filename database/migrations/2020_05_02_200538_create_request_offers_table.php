<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('help_request_id');
            $table->foreignId('user_helper');
            $table->timestamps();

            $table->foreign('help_request_id')->references('id')->on('help_requests');
            $table->foreign('user_helper')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_offers');
    }
}
