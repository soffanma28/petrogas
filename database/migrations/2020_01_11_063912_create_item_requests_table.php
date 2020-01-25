<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requestor_id');
            $table->string('employee');
            $table->integer('approver_id')->nullable();
            $table->integer('on_process_id')->nullable();
            $table->integer('ready_id')->nullable();
            $table->integer('completed_id')->nullable();
            $table->datetime('req_date')->nullable();
            $table->datetime('approve_date')->nullable();
            $table->datetime('process_date')->nullable();
            $table->datetime('ready_date')->nullable();
            $table->datetime('complete_date')->nullable();
            $table->string('status');
            $table->string('typeofrequest');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('item_requests');
    }
}
