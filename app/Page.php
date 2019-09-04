<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class Page extends Model
{
    //
    use HasApiTokens,Notifiable;
    protected $table = 'pages';
    protected $fillable = [
        'name','model','controller','note','view','routename','create_at','status','pagelink','parent_id','icons'
    ];
    public function rolepage(){
        return $this->hasMany('App\RolePage');
    }
    public function getmenu(){
      
       return   DB::table('users')
                ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->select('pages.*', 'pages.id', 'role_pages.page_id')
                ->where('users.id','=',Auth::user())
                ->whereIn('pages.status',[1,3])
                ->get();
    }
    public function getallroute(){
      
        return   DB::table('users')
                 ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                 ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                 ->join('roles', 'roles.id', '=', 'users.role_id')
                 ->select('pages.*', 'pages.id', 'role_pages.page_id')
                 //->where('users.id','=',Auth::user())
                 ->whereIn('pages.status',[2,1])
                 ->get();
     }
}
