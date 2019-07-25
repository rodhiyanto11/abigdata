<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class RolePage extends Model
{
    //
    use HasApiTokens,Notifiable;
    protected $table = 'role_pages';
    protected $fillabel = [
        'id','role_id','page_id'
    ];
  

}
