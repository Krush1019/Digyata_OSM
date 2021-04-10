<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizationsTable extends Migration {
    
    private $tbl_name1 = 'tbl_localizations';
    private $tbl_name2 = "tbl_service_localization";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name1, function (Blueprint $table) {
            $table->id('loc_id');
            $table->string('loc_state');
            $table->string('loc_location');
            $table->string('loc_agent_email')->nullable(true);
            $table->boolean('loc_d_status')->default(false);

            $table->timestamps();
        });

        Schema::create($this->tbl_name2, function (Blueprint $table) {
            $table->id("sl_id");

            $table->unsignedBigInteger("loc_id");
            $table->foreign("loc_id")->references("loc_id")->on($this->tbl_name1);

            $table->unsignedBigInteger('ser_id');
            $table->foreign('ser_id')->references('id')->on('tbl_service_catalogs');

            $table->boolean('loc_status')->default(true);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tbl_name2);
        Schema::dropIfExists($this->tbl_name1);
    }
}
