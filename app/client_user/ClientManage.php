<?php

namespace App\client_user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClientPasswordResetNotification;

class ClientManage extends Authenticatable
{
    use Notifiable;

    public function getEmailForPasswordReset()
    {
        return $this->sClEmail;
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientPasswordResetNotification($token));
    }

        protected $table = 'tbl_client_manage';

        protected $guard = 'client';

        protected $fillable = [
            'sClientID', 'sClName', 'sClEmail', 'password','sClMobile','sClGender','sClAddress'
        ];

        protected $hidden = [
            'password',
        ];
}
