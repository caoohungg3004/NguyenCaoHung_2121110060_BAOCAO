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
        Schema::create('2121110060_contact', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->comment('mã người dùng');
            $table->string('name',255)->comment('tên');
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('title',255);
            $table->mediumText('content');
            $table->unsignedInteger('replay_id');
            $table->unsignedInteger('sort_order')->comment('vị trí hiển thị');
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
        Schema::dropIfExists('2121110060_contact');
    }
};
