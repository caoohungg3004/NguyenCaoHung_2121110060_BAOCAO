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
        Schema::create('2121110060_slider', function (Blueprint $table) {
            $table->id();
            $table->string('name',1000)->comment('Tên slider');
            $table->string('link',1000);
            $table->unsignedInteger('sort_order')->default(0)->comment('vị trí hiển thị');
            $table->string('position',255);
            $table->string('image',1000);
            $table->unsignedInteger('created_by')->default(1);
            $table->unsignedInteger('update_by')->default(1);
            $table->tinyInteger('status')->default(2)->comment('trạng thái');
            $table->timestamps();//create at,update at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('2121110060_slider');
    }
};
