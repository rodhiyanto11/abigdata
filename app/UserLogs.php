<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    //
    protected $table="user_logs";
    protected $fillable = [
        'id','user_id','user_name','ip_address','location','page_id','page_name'
    ];
}
