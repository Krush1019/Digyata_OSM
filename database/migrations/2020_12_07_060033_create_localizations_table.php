<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizationsTable extends Migration {
    private $tbl_name = 'tbl_localizations';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tbl_name, function (Blueprint $table) {
            $table->id('loc_id');
            $table->string('loc_state');
            $table->string('loc_location');
            $table->string('loc_agent_email')->nullable(true);
            $table->boolean('loc_status')->default(true);
            $table->boolean('loc_d_status')->default(false);

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
