<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Role;
use App\RolePage;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
       // dd(2);
      if(isset($request->req) &&  $request->req == 'all'){
         // dd(1);
          return ['data'=> Role::all()];
      }
      
      if(isset($request->req) && $request->req == 'pagerole' ){
           // dd(2);
            if(isset($request->id)){
                if(isset($request->search)){
                    //dd($request->search);
                    return DB::table('role_pages')
                    ->join('roles','roles.id','=','role_pages.role_id')
                    ->join('pages','pages.id','=','role_pages.page_id')
                    ->select('role_pages.id','role_pages.role_id','role_pages.page_id','roles.name as role_name','pages.name as page_name','role_pages.created_at')
                    ->where('roles.id','=',$request->id)
                    ->where('pages.name', 'ilike', '%' . $request->search . '%')
                    ->get();      
                }else{
                    return DB::table('role_pages')
                    ->join('roles','roles.id','=','role_pages.role_id')
                    ->join('pages','pages.id','=','role_pages.page_id')
                    ->select('role_pages.id','role_pages.role_id','role_pages.page_id','roles.name as role_name','pages.name as page_name','role_pages.created_at')
                    ->where('roles.id','=',$request->id)
                    ->get();  
                }
                
            }else{
                return DB::table('role_pages')
                    ->join('roles','roles.id','=','role_pages.role_id')
                    ->join('pages','pages.id','=','role_pages.page_id')
                    ->select('role_pages.id','role_pages.role_id','role_pages.page_id','roles.name as role_name','pages.name as page_name','role_pages.created_at')
                    ->get();     
            }
            
        
      }
      if(isset($request->search) &&  strlen($request->search) > 0){
        //dd(3);
        return Role::latest()
                    ->where('name', 'ilike', '%' . $request->search . '%')      
                    ->paginate(100);
        }
      if(isset($request->req) && $request->req == 'delete' ){
          //dd(2);
        $delete = RolePage::findOrFail($request->id);
        $delete = $delete->delete();
        return response([
            'data' => $delete
        ],Response::HTTP_CREATED);
      }
    return Role::latest()->paginate(100);
      
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->page_id);

        if(isset($request->header) && $request->header == 'rolepages'){
            //dd($request->page_id);
            $this->validate($request,
            [
                'role_id'      => 'required|max:191',
                'page_id'      => 'required|max:191',
            ]);

            $data = RolePage::create([
                'role_id'      => $request['role_id'],
                'page_id'      => $request['page_id'],
            ]);
            return response([
                'data' => $data
            ],Response::HTTP_CREATED);
        }else{
            //dd(1);
            //roleinsert
        $this->validate($request,
        [
            'name' => 'required|string|max:191',
            
        ]);
        
        $data = Role::create([
            'name' => $request['name'],
            'note' => $request['note'],
        ]);
        return response([
            'data' => $data
        ],Response::HTTP_CREATED);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       //dd($id);
        $this->validate($request,
        [
            'name'      => 'required|string|max:191',
           
        ]);
        
        $update = Role::findOrFail($id);
       // dd($update);
        $update->name = $request->name;
        $update->note = $request->note;
        $update->save();
        return response([
            'data' => $update
        ],Response::HTTP_CREATED);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$method = null)
    {
        //
        //dd($method);
        $delete = Role::findOrFail($id);
        $delete = $delete->delete();
        return response([
            'data' => $delete
        ],Response::HTTP_CREATED);
    }
}
