<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicelistsTable extends Migration {

    private $tbl_name = "tbl_user_ser_list";
    private $tbl_name2 = "tbl_user_ser_item_price";

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id('ser_id');
            $table->unsignedBigInteger('uID');
            $table->foreign('uID')->references('uID')->on("tbl_user_manage");
            $table->string('ser_pro_name');
            $table->string('user_ser_exp');

            $table->text('ser_dec');
            $table->string('ser_phone')->nullable();
            $table->string('ser_email')->nullable();
            $table->string('ser_web')->nullable();
            $table->string('ser_fb')->nullable();
            $table->string('ser_tw')->nullable();
            $table->string('ser_linkedin')->nullable();

            $table->string('ser_photo');
            $table->string('doc_no');
            $table->string('doc_image');

            $table->string('ser_days')->nullable(); // MON, TUE, WEN,... 
            $table->string('ser_time')->nullable(); // 6-18, 7-8,...
            $table->boolean('ser_status')->default(1);

            $table->timestamps();
        });

        Schema::create($this->tbl_name2, function (Blueprint $table) {
            $table->id('item_id');
            $table->unsignedBigInteger('ser_id');
            $table->foreign('ser_id')->references('ser_id')->on($this->tbl_name);
            $table->unsignedBigInteger('uID');
            $table->foreign('uID')->references('uID')->on("tbl_user_manage");
            $table->string('item_name');
            $table->string('item_des');
            $table->string('item_price');
            $table->boolean('item_status')->default(1);

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
        Schema::dropIfExists($this->tbl_name2);
    }
}
