<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_items', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('f_name', 255);
            $table->string('l_name', 255)->nullable();
            $table->string('phone_number', 255);
            $table->string('country_code', 255);
            $table->string('timezone_name', 255);
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
        Schema::dropIfExists('phone_items');
    }
}
