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
          $table->unsignedBigInteger("BsID");
          $table->foreign("BsID")->references("BsID")->on("tbl_booking_schedule");
          $table->unsignedBigInteger("ser_id");
          $table->foreign("ser_id")->references("id")->on("tbl_service_catalogs");
          $table->unsignedBigInteger("cl_ID");
          $table->foreign("cl_ID")->references("id")->on("tbl_client_manage");
          $table->unsignedBigInteger("uID");
          $table->foreign("uID")->references("id")->on("tbl_user_manage");
          $table->longText("ltFeedback")->nullable(true);
          $table->integer("iReview_Rating");
          $table->float("iReview_Avg_Rating");
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
