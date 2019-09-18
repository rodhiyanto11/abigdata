<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    //
    protected $table="user_logs";
    protected $fillable = [
        'id','user_id','user_name','ip_address','latitude','longitude','page_id','page_name','country','region','action','country_name','city'
    ];
}
