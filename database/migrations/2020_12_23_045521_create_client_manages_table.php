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
            $table->bigIncrements("id");
            $table->string("sClientID")->nullable();
            $table->string('sClName');
            $table->string('sClEmail')->unique();
            $table->string('sClMobile');
            $table->string('sClAddress');
            $table->string('password');
            $table->string('sClGender');
            $table->string('sClPhotoURL')->nullable();
            $table->string('sClWorkPlace')->nullable();
            $table->string('sClProf')->nullable();
            $table->string('sClExp')->nullable();
            $table->string('sClAvalibility')->nullable();
            $table->string('sClIDName')->nullable();
            $table->string('sClIDURL')->nullable();
            $table->string('sClientStatus')->default('Pending');
            $table->rememberToken();
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
