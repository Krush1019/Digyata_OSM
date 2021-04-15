<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewOrders extends Model
{
  protected $table = "tbl_review_orders";
  protected $fillable=['ser_id','uID','Res_R1','Ser_R2','Com_R3','Price_R4','Title','Feedback','Image'];

}
