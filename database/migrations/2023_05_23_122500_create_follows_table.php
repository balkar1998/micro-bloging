<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id'); // The user who is following
            $table->unsignedBigInteger('following_id'); // The user who is being followed
            $table->timestamps();

            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade'); // If a user is deleted, delete all of their followers
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade'); // If a user is deleted, delete all of the users they are following
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
};
