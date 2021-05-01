<?php

namespace App\client_user;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use App\Notifications\CustomerPasswordResetNotification;

class UserManage extends Authenticatable
{
    use Notifiable;
    public function getEmailForPasswordReset()
    {
        return $this->sUserEmail;
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerPasswordResetNotification($token));
    }

         protected $table = 'tbl_user_manage';

        protected $guard = 'customer';

        protected $fillable = [
            'sUserID', 'sUserName', 'sUserEmail', 'password', 'sUserMobile','sUserGender', 'sUserAddress'
        ];

        protected $hidden = [
            'password',
        ];
}
