<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_service_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string("serviceName");
            $table->string("serviceCategory");
            $table->text("serviceDescription")->nullable(true);
            $table->integer("serviceMinPrice");
            $table->integer("serviceMaxPrice");
            $table->boolean("serviceStatus")->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('tbl_service_catalogs');
    }
}
