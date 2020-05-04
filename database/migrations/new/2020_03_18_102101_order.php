<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->uuid('request_uuid');
            $table->uuid('bid_uuid');
            $table->uuid('request_user_uuid');
            $table->uuid('shipper_user_uuid');
            $table->decimal('amount' , 10,2);
            $table->enum('status', ['processing' , 'transit' , 'delivered' , 'completed'])->default('processing');
            $table->date('pickup_date');
            $table->date('arrived_date');
            $table->smallInteger('ratings')->default(5);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('request_user_uuid')->references('uuid')->on('users');
            $table->foreign('shipper_user_uuid')->references('uuid')->on('users');
            //$table->foreign('request_uuid')->references('uuid')->on('user_requests');
            //$table->foreign('bid_uuid')->references('uuid')->on('bids');
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
