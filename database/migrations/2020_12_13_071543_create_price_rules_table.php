<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRulesTable extends Migration {
    private $tableName = "tbl_price_rule";

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id('pr_id');
            $table->unsignedBigInteger('ser_id');
            $table->foreign('ser_id')->references('id')->on('tbl_service_catalogs');
            $table->string('iVisit')->default(10);
            $table->string('iService')->default(2);
            $table->boolean('pr_status')->default(1);
            $table->boolean('pr_d_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tableName);
    }
}
