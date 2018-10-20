<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('actual_url');
            $table->string('url_code')->nullable();
            $table->unsignedInteger('url_counter')->default(0);
            $table->dateTime('expiration_time')->nullable();
            $table->unsignedInteger('status')->default('1')->comment('0:deleted, 1:active, 2:expired, 3:black listed');
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
        Schema::dropIfExists('url_details');
    }
}
