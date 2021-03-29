<?php

namespace App\client_user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClientManage extends Authenticatable
{
    use Notifiable;

        protected $table = 'tbl_client_manage';

        protected $guard = 'client';

        protected $fillable = [
            'sClientID', 'sClName', 'sClEmail', 'password','sClMobile','sClGender','sClAddress'
        ];

        protected $hidden = [
            'password',
        ];
}
