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
        // Rename the 'image' column to 'media'
        Schema::table('messages', function (Blueprint $table) {
            $table->string('media')->nullable()->after('id'); // Add a new column called 'media' after the 'id' column
            $table->dropColumn('image'); // Drop the 'image' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rename the 'media' column to 'image'
        Schema::table('messages', function (Blueprint $table) {
            $table->string('image')->nullable()->after('id');
            $table->dropColumn('media');
        });
    }
};
