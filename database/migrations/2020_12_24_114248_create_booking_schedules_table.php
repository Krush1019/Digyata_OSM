<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingSchedulesTable extends Migration {
    private $tbl_name = "tbl_booking_schedule";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id('bsID');
            $table->string('sOrderId');
            $table->unsignedBigInteger('ser_id');
            $table->foreign("ser_id")->references("id")->on("tbl_service_catalogs");
            $table->unsignedBigInteger('cl_ID');
            $table->foreign('cl_ID')->references('id')->on('tbl_client_manage');
            $table->unsignedBigInteger('uID');
            $table->foreign('uID')->references('id')->on('tbl_user_manage');
            $table->string('sAddress');
            $table->timestamp('sTimeSlot');
            $table->string('sAmount');
            $table->boolean('bPayStatus');
            $table->boolean('bSerStatus')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tbl_name);
    }
}
