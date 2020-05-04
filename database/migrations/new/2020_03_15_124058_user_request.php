<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->uuid('user_uuid');
            $table->unsignedBigInteger('item_size_id');
            $table->unsignedBigInteger('item_category_id');
            $table->string('weight')->nullable();
            $table->enum('weight_unit', ['kg' , 'lb'])->default('kg');
            $table->string('img_path')->nullable();
            $table->string('description')->nullable();
            $table->json('drop_location');
            $table->json('pickup_location');
            $table->string('receiver_name', 100);
            $table->enum('contact_mode' , ['phone' , 'email']);
            $table->string('contact_value');
            $table->date('delivery_date');
            $table->enum('status' , ['open' , 'closed' , 'processing' , 'transit' , 'completed' , 'in_query'])->default('open');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_uuid')->references('uuid')->on('users');
            $table->foreign('item_size_id')->references('id')->on('item_sizes');
            $table->foreign('item_category_id')->references('id')->on('item_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_requests');
    }
}
