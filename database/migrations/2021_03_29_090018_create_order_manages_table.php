<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderManagesTable extends Migration {

    private $tbl_name = "tbl_order_manages";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create($this->tbl_name, function (Blueprint $table) {

            // $table->id();
            $table->id('order_id');
            $table->string('sOrderId');

            // $table->unsignedBigInteger('ser_cat_id');
            // $table->foreign("ser_cat_id")->references("id")->on("tbl_service_catalogs");

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('tbl_client_manage');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tbl_user_manage');

            $table->unsignedBigInteger('ser_list_id');
            $table->foreign("ser_list_id")->references("ser_id")->on("tbl_user_ser_list");

            $table->string("ser_item_id");
            // $table->unsignedBigInteger('item_id');
            // $table->foreign('item_id')->references('item_id')->on('tbl_user_ser_item_price');

            $table->date('sbDate');
            $table->string('sAddress');
            $table->string('sTimeSlot');
            $table->string('sAmount');
            $table->boolean('bPayStatus')->default(0);
            $table->string('bSerStatus')->default("pending"); // approved, cancel

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
