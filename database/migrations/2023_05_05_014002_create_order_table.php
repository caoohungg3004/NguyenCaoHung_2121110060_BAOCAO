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
        Schema::create('2121110060_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('mã người dùng');
            $table->string('name',255)->comment('tên người dùng');
            $table->string('email',255)->comment('email người dùng');
            $table->string('phone',255)->comment('sdt người dùng');
            $table->string('address',255)->comment('địa chỉ người dùng');
            $table->string('note',255);
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
        Schema::dropIfExists('2121110060_order');
    }
};
