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
        $datapages = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('role_pages', 'role_pages.role_id', '=', 'user_roles.role_id')
            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
            ->select('pages.*', 'pages.id', 'role_pages.page_id')
            ->where('users.id','=',Auth::user()->id)
            ->get();
       // dd($datapages); 
   
        return view('home',['menus'=>$datapages]);
      
        
    }
    
}
