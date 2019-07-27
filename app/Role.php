<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    use HasApiTokens,Notifiable;
    protected $table = 'roles';
    protected $fillable = [
        'id','name','note','create_at'
    ];
    public function rolepage(){
        return $this->hasMany('App\RolePage');
    }
}
