<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class UserRole extends Model
{
    // 
    use HasApiTokens,Notifiable;
    protected $table = 'user_roles';
    protected $fillabel = [
        'id','user_id','role_id'
    ];
   


}
