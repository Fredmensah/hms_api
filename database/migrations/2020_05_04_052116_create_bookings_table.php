<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('checkIn');
            $table->date('checkOut');
            $table->string('type');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('customer_id');
            $table->decimal('room_discount' , 8 , 2)->default(0);
            $table->decimal('room_type_discount' , 8 , 2)->default(0);
            $table->decimal('price' , 8 , 2);
            $table->enum('status', ['active' , 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
