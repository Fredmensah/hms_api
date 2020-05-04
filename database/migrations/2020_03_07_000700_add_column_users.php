<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstName');
            $table->string('otherNames');
            $table->string('contact');
            $table->string('profilePic')->nullable();
            $table->enum('status' , ['suspended' , 'active' , 'inactive'])->default('inactive');
            $table->boolean('idVerified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstName');
            $table->dropColumn('otherNames');
            $table->dropColumn('contact');
            $table->dropColumn('profilePic');
            $table->dropColumn('status');
            $table->dropColumn('idVerified');
        });
    }
}
