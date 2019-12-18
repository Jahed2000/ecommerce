<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('phone_no')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('ip_address')->nullable(); 
            $table->string('avatar')->nullable(); 
            $table->string('street_address'); 
            $table->unsignedInteger('division_id'); 
            $table->unsignedInteger('district_id'); 
            $table->text('shipping_address')->nullable(); 
            $table->unsignedTinyInteger('status')->default(0)->comment('0 mane inactive and 1 mane active, 2 mane ban'); 

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
