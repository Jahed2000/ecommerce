<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('payment_id')->nullable(); 
            $table->string('ip_address')->nullable();
            $table->string('email')->nullable();
            $table->string('message')->nullable();  //user_id,ip,email,message nullable so unregistered users can also order
            $table->string('phone_no');
            $table->string('name');
            $table->text('shipping_address');
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->boolean('is_seen_by_admin')->default(0);
            $table->string('transaction_id')->nullable();
            $table->timestamps();


            $table->foreign('user_id')
            ->references('id')->on('users')//this is to delete all orders of the user if user is deleted.make sure 'id' on user table is unsignedBigIncrement and 'user_id' on orders is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur. 
            ->onDelete('cascade');

            $table->foreign('payment_id')
            ->references('id')->on('payments')//this is to delete all orders of the user if user is deleted.make sure 'id' on payments table is unsignedBigIncrement and 'payment_id' on orders is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur. 
            ->onDelete('cascade');

            $table->integer('shipping_charge')->default(60);
            $table->integer('custom_discount')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
