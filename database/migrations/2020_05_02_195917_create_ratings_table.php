<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_request_id');
            $table->foreignId('user_helper_id');
            $table->tinyInteger('rating')->default(0);
            $table->string('review')->nullable();
            $table->foreignId('help_request_id');
            $table->timestamps();

            $table->foreign('user_request_id')->references('id')->on('users');
            $table->foreign('user_helper_id')->references('id')->on('users');
            $table->foreign('help_request_id')->references('id')->on('help_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
