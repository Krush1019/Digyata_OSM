<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCatalog extends Model
{
    protected $table = 'tbl_service_catalogs';
    protected $fillable=['serviceName','serviceCategory','serviceDescription','serviceMinPrice','serviceMaxPrice'];
    use SoftDeletes;
}
