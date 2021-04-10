<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model {
    protected $table = "tbl_ser_list";

    protected $fillable = [ 
        "client_id" ,"ser_cat_id" ,"ser_pro_name" ,"user_ser_exp" ,
        "ser_dec" ,"ser_phone" ,"ser_email" ,"ser_web" ,"ser_fb" ,
        "ser_tw" ,"ser_linkedin" ,"ser_photo" ,"doc_no" ,"doc_image" ,
        "ser_days" ,"ser_time" , "ser_state", "ser_city", "ser_address", 
        "pin_no", "ser_item_id"
    ];
}
