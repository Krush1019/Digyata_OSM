<?php

namespace App\client_user;

use Illuminate\Database\Eloquent\Model;

class OrderManage extends Model {

    protected $table = "tbl_order_manages";

    protected $fillable = [
      'sOrderId', 'client_id', 'user_id', 'ser_list_id', 'ser_item_id','sbDate', 'sAddress', 'sTimeSlot', 'sAmount'
  ];

}
