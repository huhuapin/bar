<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(1); //店员
            $table->unsignedInteger('member_id')->nullable(); //会员
            $table->integer('total_count')->nullable(); //总件数
            $table->double('total_price')->default(0); //总价格
            $table->integer('table_number')->nullable(); //桌号
            $table->double('discount')->default(1);    //折扣
            $table->double('real_price')->default(0);  //实际价格
            $table->string('remark')->nullable();    //备注
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('member_id')->references('id')->on('member');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
