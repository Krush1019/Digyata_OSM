<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCatalogsTable extends Migration {

    private $tbl_name = "tbl_service_catalogs";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id();
            $table->string("serviceName");
            $table->string("serviceCategory");
            $table->text("serviceDescription")->nullable(true);
            
            $table->string("serviceImage");

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
        Schema::dropIfExists($this->tbl_name);
    }
}
