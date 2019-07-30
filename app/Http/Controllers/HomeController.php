<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($getmenu = null)
    {
        //dd($getmenu);
        //next looping role baru di fetch jadi menu kecil2
        $datarole = DB::table('roles')->get()->toArray();
        //dd($datarole);
        //foreach($datarole as $dataroles){
            $datapages['admin'] = DB::table('users')
                            //->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                            ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                            ->join('roles', 'roles.id', '=', 'users.role_id')
                            ->select('pages.*', 'pages.id', 'role_pages.page_id')
                            ->where('users.id','=',Auth::user()->id)
                            ->where('roles.name','=','admin')
                            ->get();
            if(count($datapages['admin']) > 0){
               // dd(1);
                $datapages['users'] = DB::table('role_pages')
                           
                            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                            ->join('roles', 'roles.id', '=', 'role_pages.role_id')
                            ->select('pages.*', 'pages.id', 'role_pages.page_id')
                           // ->where('users.id','=',Auth::user()->id)
                            ->where('roles.name','<>','admin')
                            ->get();  
            }else{
               // dd(2);
                $datapages['users'] = DB::table('users')
                            //->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                            ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                            ->join('roles', 'roles.id', '=', 'users.role_id')
                            ->select('pages.*', 'pages.id', 'role_pages.page_id')
                            ->where('users.id','=',Auth::user()->id)
                            ->where('roles.name','<>','admin')
                            ->get();  
            }                
                          
       // }
        //dd($datapages);
        
     //  dd($datapages); 
   
        return view('home',$data = ['menus'=>$datapages]);
      
        
    }
    
}
