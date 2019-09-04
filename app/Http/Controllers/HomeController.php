<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserRole;
use App\Page;
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
        $datarole = DB::table('roles')->get()->toArray();
        
            $first_role = UserRole::where('user_id',Auth::user()->id)->get()->toArray();
           
            if($first_role){
                $datapages['admin'] = DB::table('users')
                            ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                            ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                            ->join('roles', 'roles.id', '=', 'users.role_id')
                            ->select('pages.*', 'pages.id', 'role_pages.page_id')
                            ->where('users.id','=',Auth::user()->id)
                            ->whereIn('pages.status',[5])
                            ->whereNull('pages.parent_id')
                            ->orderBy('pages.name', 'asc')
                            ->get();
                          // dd($datapages['admin']);
                           // $i = 0;
                          //  echo count($datapages['admin']);die();
                            for($i = 0 ; $i < count($datapages['admin']) ; $i++){
                                if(strlen($datapages['admin'][$i]->parent_id) == 0 ){
                                   
                                    $arrmenu[$i]['id']          = $datapages['admin'][$i]->id;
                                    $arrmenu[$i]['name']        = $datapages['admin'][$i]->name;
                                    $arrmenu[$i]['routename']   = $datapages['admin'][$i]->routename;
                                    $arrmenu[$i]['status']      = $datapages['admin'][$i]->status;
                                    $arrmenu[$i]['parent_id']   = $datapages['admin'][$i]->parent_id;
                                    $arrmenu[$i]['view']        = $datapages['admin'][$i]->view;
                                    $arrmenu[$i]['icons']        = $datapages['admin'][$i]->icons;
                                    $arrmenu[$i]['pagelink']    =  (strlen($datapages['admin'][$i]->pagelink) > 0 ? "{path:'/".$datapages['admin'][$i]->view."',name:'".$datapages['admin'][$i]->routename."',params : {t_path : '".$datapages['admin'][$i]->pagelink."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}}}": "{path:'/".$datapages['admin'][$i]->view."',name:'".$datapages['admin'][$i]->routename."',params : {t_path : 'View',t_url : 'False'}}");
                                    $countsub = DB::table('users')
                                                ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                                                ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                                                ->join('roles', 'roles.id', '=', 'users.role_id')
                                                ->select('pages.*', 'pages.id', 'role_pages.page_id')
                                                ->where('users.id','=',Auth::user()->id)
                                                ->where('pages.parent_id','=',$datapages['admin'][$i]->id)
                                               // ->where('pages.status','<>','2')
                                                ->orderBy('pages.name', 'asc')
                                                ->get(); 
                                    //             echo "<pre>";
                                    // print_r($countsub);
                                    // echo "</pre>";
                                    if($countsub->count() > 0){
                                        for($j = 0 ; $j < $countsub->count() ; $j++){
                                          //  echo $j;die();
                                                $arrmenu[$i]['submenu'][$j]['id']          = $countsub[$j]->id;
                                                $arrmenu[$i]['submenu'][$j]['name']        = $countsub[$j]->name;
                                                $arrmenu[$i]['submenu'][$j]['routename']   = $countsub[$j]->routename;
                                                $arrmenu[$i]['submenu'][$j]['status']      = $countsub[$j]->status;
                                                $arrmenu[$i]['submenu'][$j]['parent_id']   = $countsub[$j]->parent_id; 
                                                $arrmenu[$i]['submenu'][$j]['view']        = $countsub[$j]->view;
                                                $arrmenu[$i]['submenu'][$j]['icons']        = $countsub[$j]->icons;
                                                //$arrmenu[$i]['submenu'][$j]['pagelink']    =  "{path:'/".$countsub[$j]->view."',name:'".$countsub[$j]->routename."',params : { t_path : '".(strlen($countsub[$j]->pagelink) > 0 ? $countsub[$j]->pagelink : 'View')."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}} }";
                                                $arrmenu[$i]['submenu'][$j]['pagelink']    =  (strlen($countsub[$j]->pagelink) > 0 ? "{path:'/".$countsub[$j]->view."',name:'".$countsub[$j]->routename."',params : {t_path : '".$countsub[$j]->pagelink."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}}}": "{path:'/".$countsub[$j]->view."',name:'".$countsub[$j]->routename."',params : {t_path : 'View',t_url : 'False'}}");

                                                $b =  DB::table('users')
                                                ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                                                ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                                                ->join('roles', 'roles.id', '=', 'users.role_id')
                                                ->select('pages.*', 'pages.id', 'role_pages.page_id')
                                                ->where('users.id','=',Auth::user()->id)
                                                ->where('pages.parent_id','=',$countsub[$j]->id)
                                               // ->where('pages.status','<>','2')
                                                ->orderBy('pages.name', 'asc')
                                                ->get();
                                               
                                                if($b->count() > 0){
                                                    for($k = 0 ; $k < $b->count() ; $k++){
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['id']          = $b[$k]->id;
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['name']        = $b[$k]->name;
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['routename']   = $b[$k]->routename;
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['status']      = $b[$k]->status;
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['parent_id']   = $b[$k]->parent_id; 
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['view']        = $b[$k]->view;
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['icons']       = $b[$k]->icons;
                                                             //$arrmenu[$i]['submenu'][$j]['submenu'][$k]['pagelink']    = "{path:'/".$b[$k]->view."',name:'".$b[$k]->routename."',params : { t_path : '".(strlen($b[$k]->pagelink) > 0 ? $b[$k]->pagelink : 'View') ."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}} }";
                                                             $arrmenu[$i]['submenu'][$j]['submenu'][$k]['pagelink']    =  strlen($b[$k]->pagelink) > 0 ? "{path:'/".$b[$k]->view."',name:'".$b[$k]->routename."',params : {t_path : '".$b[$k]->pagelink."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}}}": "{path:'/".$b[$k]->view."',name:'".$b[$k]->routename."',params : {t_path : 'View',t_url : 'False'}}";
                                                             $c = DB::table('users')
                                                             ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
                                                             ->join('pages', 'pages.id', '=', 'role_pages.page_id')
                                                             ->join('roles', 'roles.id', '=', 'users.role_id')
                                                             ->select('pages.*', 'pages.id', 'role_pages.page_id')
                                                             ->where('users.id','=',Auth::user()->id)
                                                             ->where('pages.parent_id','=',$b[$k]->id)
                                                             //->where('pages.status','<>','2')
                                                             ->orderBy('pages.name', 'asc')
                                                             ->get();
                                                            //s dd($b);
                                                             if($c->count() > 0){
                                                                 for($l = 0 ; $l < $c->count() ; $l++){
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['id']          = $c[$l]->id;
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['name']        = $c[$l]->name;
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['routename']   = $c[$l]->routename;
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['status']      = $c[$l]->status;
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['parent_id']   = $c[$l]->parent_id; 
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['view']        = $c[$l]->view;
                                                                          $arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['icons']        = $c[$l]->icons;
                                                                          //$arrmenu[$i]['submenu'][$j]['submenu'][$k]['submenu'][$l]['pagelink']    = "{path:'/".$c[$l]->view."',name:'".$c[$l]->routename."',params : { t_path : '".(strlen($c[$l]->pagelink) > 0 ? $c[$l]->pagelink : false)."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}} }";
                                                                          $arrmenu[$i]['submenu'][$j]['pagelink'][$k]['submenu'][$l]['pagelink']    =  (strlen($c[$l]->pagelink) > 0 ?"{path:'/".$c[$l]->view."',name:'".$c[$l]->routename."',params : {t_path : '".$c[$l]->pagelink."',t_url : {filter : {select : {data : ['abc','abc','abd']}}}}}": "{path:'/".$c[$l]->view."',name:'".$c[$l]->routename."',params : {t_path : 'View',t_url : 'False'}}");
                                                             
                                                                 }
                                                             }     
                                                            
                                                    }
                                                }     
                                        }
                                    }                 
                                                       
                                }    
                            }
                           // die();
                            $datapages['menu'] = $arrmenu;
                           //dd($arrmenu);
                            return view('home',$data = ['menus'=>$datapages]);            
            }else{
                return view('home');
            }
    }
  
}
