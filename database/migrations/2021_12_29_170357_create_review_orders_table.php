<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewOrdersTable extends Migration
{
  private $tableName = "tbl_review_orders";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
          $table->id("RoID");
          $table->unsignedBigInteger("order_id");
          $table->foreign("order_id")->references("order_id")->on("tbl_order_manages");
          $table->unsignedBigInteger("ser_id");
          $table->foreign("ser_id")->references("id")->on("tbl_service_catalogs");
          $table->unsignedBigInteger("cl_ID");
          $table->foreign("cl_ID")->references("id")->on("tbl_client_manage");
          $table->unsignedBigInteger("uID");
          $table->foreign("uID")->references("id")->on("tbl_user_manage");

          $table->integer("Res_R1");
          $table->integer("Ser_R2");
          $table->integer("Com_R3");
          $table->integer("Price_R4");

          $table->float("Avg_Rating");
          $table->float("Overall_Rating");

          $table->string("Title")->nullable();
          $table->longText("Feedback")->nullable(true);
          
          $table->string("Image")->nullable();
          
          $table->boolean("bReview_Status");
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
        Schema::dropIfExists($this->tableName);
    }
}
