<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    use HasApiTokens,Notifiable;
    protected $table = 'pages';
    protected $fillable = [
        'name','model','controller','note','view','create_at'
    ];
  
}
