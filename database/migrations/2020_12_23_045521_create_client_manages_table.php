<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientManagesTable extends Migration {
    private $tbl_name = "tbl_client_manage";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id("cl_ID");
            $table->string("sClientID");
            $table->string('sClName');
            $table->string('sClPhotoURL');
            $table->string('sClWorkPlace');
            $table->string('sClProf');
            $table->string('sClLoc');
            $table->string('sClExp');
            $table->string('sClAvalibility');
            $table->string('sClPhone');
            $table->string('sClEmail');
            $table->string('sClIDName');
            $table->string('sClIDURL');
            $table->string('sClientStatus')->default('Pending');
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
