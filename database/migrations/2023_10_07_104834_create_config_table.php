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
        Schema::create('2121110060_config', function (Blueprint $table) {
            $table->id();
            $table->string("author");
            $table->string("email");
            $table->string("phone");
            $table->string("zalo");
            $table->string("address");
            $table->string("facebook");
            $table->string("metadesc");
            $table->string("metakey");
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->unsignedBigInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('2121110060_config');
    }
};
