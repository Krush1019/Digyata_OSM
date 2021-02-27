<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountPromosTable extends Migration
{
    private $tbl_name = 'tbl_Discount_Promocode';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id('dpc_Id');
            $table->string('sdpc_name');
            $table->string('sdpc_type');
            $table->float('fdpc_discount');
            $table->float('fdpc_minAmount')->nullable(true);
            $table->boolean('bdpc_status')->default(true);
            $table->boolean('bdpc_d_status')->default(false);
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
