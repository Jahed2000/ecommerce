<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->integer('product_quantity')->default(1);
            
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');//make sure 'id' on users table is unsignedBigIncrement and 'user_id' on this table is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');//make sure 'id' on products table is unsignedBigIncrement and 'product_id' on this table is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur

            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade'); //make sure 'id' on orders table is unsignedBigIncrement and 'order_id' on this table is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
