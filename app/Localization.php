<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localization extends Model {

    protected $table = "tbl_localizations";

    protected $fillable = ['loc_state','loc_location','ser_id','loc_agent_email'];
}
