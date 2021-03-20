<?php

namespace App\client_user;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

class UserManage extends Authenticatable
{
    use Notifiable;

         protected $table = 'tbl_user_manage';

        protected $guard = 'customer';

        protected $fillable = [
            'sUserName', 'sUserEmail', 'password','sUserMobile','sUserGender','sUserAddress'
        ];

        protected $hidden = [
            'password',
        ];
}
