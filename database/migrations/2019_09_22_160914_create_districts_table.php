<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('division_id');
            $table->timestamps();

            $table->foreign('division_id')
            ->references('id')->on('divisions')
            ->onDelete('cascade'); //make sure 'id' on division table is unsignedBigIncrement and 'division_id' on this table is unsignedBigInteger i.e. both primary key and foreign key types must be exactly the same or an error will occur
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
