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
            $table->string("sClientID");
            $table->string('sClName');
            $table->string('sClEmail')->unique();
            $table->string('sClMobile');
            $table->string('password');
            $table->string('sClGender');
            $table->string('sClPhotoURL')->default("images/default-img/user.png");
            $table->string('sClientStatus')->default('Active');
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
