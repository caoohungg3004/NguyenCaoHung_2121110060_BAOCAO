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
        Schema::create('2121110060_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('topic_id')->comment('mã ');
            $table->string('title', 1000)->default('text');
            $table->string('slug',1000)->unique()->comment('slug danh mục');
            $table->mediumText('detail');
            $table->string('image',1000)->nullable();
            $table->string('type', 100);
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
        Schema::dropIfExists('2121110060_post');
    }
};
