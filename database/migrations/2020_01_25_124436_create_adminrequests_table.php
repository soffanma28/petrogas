<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->integer('adminprove_id')->nullable();
            $table->integer('admincompleted_id')->nullable();
            $table->datetime('adminprove_date')->nullable();
            $table->datetime('admincomplete_date')->nullable();
            $table->string('adminstatus')->nullable();
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
        Schema::dropIfExists('adminrequests');
    }
}
