<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_request_id');
            $table->foreignId('user_helper_id')->nullable();
            $table->foreignId('category_id');
            $table->double('latitude');
            $table->double('longitude');

            $table->timestamps();

            $table->foreign('user_request_id')->references('id')->on('users');
            $table->foreign('user_helper_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('help_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('help_requests');
    }
}
