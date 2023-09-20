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
        Schema::create('2121110060_brand', function (Blueprint $table) {
            $table->id();//id
            $table->string('name',1000)->unique()->comment('Tên danh mục');
            $table->string('slug',1000)->unique()->comment('slug danh mục');
            $table->string('image',1000)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->comment('vị trí hiển thị');
            $table->string('metakey',255)->unique()->comment('từ khóa tìm kiếm');
            $table->string('metadesc',255)->unique()->comment('mô tả');
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
        Schema::dropIfExists('2121110060_brand');
    }
};
