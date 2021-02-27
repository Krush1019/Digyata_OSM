<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserManagesTable extends Migration {
    private $tbl_name = 'tbl_user_manage';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id('uID');
            $table->string('sUserID');
            $table->string('sUserName');
            $table->string('sUserImgURL');
            $table->string('sUserPhone');
            $table->string('sUserEmail');
            $table->string('sUserLoc');
            $table->boolean('bUserStatus')->default(1);

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
