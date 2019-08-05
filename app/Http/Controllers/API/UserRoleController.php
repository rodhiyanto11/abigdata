<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserRole;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class UserRoleController extends Controller
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
        if(isset($request->key)){
            
            return DB::table('user_roles')
            ->join('roles','roles.id','=','user_roles.role_id')
            ->join('users','users.id','=','user_roles.user_id')
            ->select('user_roles.id','user_roles.role_id','user_roles.user_id','roles.name as role_name','users.name as user_name','user_roles.created_at')
            ->where('users.id','=',$request->id)
            ->where('roles.name', 'ilike', '%' . $request->key . '%')
            //->orWhere('roles.id', 'ilike', '%' . $request->search . '%')
            ->get();  
        }else{
            
            if($request->id == 'profile'){
                return DB::table('user_roles')
                ->join('roles','roles.id','=','user_roles.role_id')
                ->join('users','users.id','=','user_roles.user_id')
                ->select('user_roles.id','user_roles.role_id','user_roles.user_id','roles.name as role_name','users.name as user_name','user_roles.created_at')
                ->where('users.id','=',auth('api')->user()->id)
                ->get();  
            }else{
                return DB::table('user_roles')
                ->join('roles','roles.id','=','user_roles.role_id')
                ->join('users','users.id','=','user_roles.user_id')
                ->select('user_roles.id','user_roles.role_id','user_roles.user_id','roles.name as role_name','users.name as user_name','user_roles.created_at')
                ->where('users.id','=',$request->id)
                ->get();  
            }
            
        }
        
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
        $this->validate($request,
            [
                'role_id'      => 'required|max:191',
                'user_id'      => 'required|max:191',
            ]);

            $data = UserRole::create([
                'role_id'      => $request['role_id'],
                'user_id'      => $request['user_id'],
            ]);
            $update          = User::where('id', $request['user_id'])->firstOrFail();
           // dd(1);
            $update->role_id = $request['role_id']; 
            $update->save();
            return response([
                'data' => $data
            ],Response::HTTP_CREATED);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = UserRole::findOrFail($id);
        $delete = $delete->delete();
        return response([
            'data' => $delete
        ],Response::HTTP_CREATED);
    }
}
