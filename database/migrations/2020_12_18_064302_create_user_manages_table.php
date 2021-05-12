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
            $table->bigIncrements('id');
            $table->string('sUserID')->nullable();
            $table->string('sUserName');
            $table->string('sUserEmail')->unique();
            $table->string('sUserMobile')->nullable();
            $table->string('sUserGender')->nullable();
            $table->string('password');
            $table->string('sUserImgURL')->nullable();
            $table->string('sUserState')->nullable();
            $table->string('sUserCity')->nullable();
            $table->string('sUserHouseNo')->nullable();
            $table->string('sUserArea')->nullable();
            $table->integer('sUserPincode')->nullable();
            $table->boolean('bUserStatus')->default(1);
            $table->string('google_id')->nullable();
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
