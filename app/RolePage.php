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
    protected $fillable = [
        'id','role_id','page_id','stt_rp'
    ];
  
   
}
