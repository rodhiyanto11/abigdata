<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
       
        if(isset($request->getprofile) && $request->getprofile == true){
            return ['data' => auth('api')->user() ];
        }
        if(isset($request->req) &&  $request->req == 'menu'){
            return $this->showmenu();
        }
       
        return User::latest()->paginate(10);
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
    //   dd($request);
        $this->validate($request,
        [
            'name'      => 'required|string|max:191',
            'username'  => 'required|string|max:191|unique:users',
            'email'     => 'required|string|email|max:191|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'role_id'  =>  'required|int',
         
        ]);
        
        $data = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'role_id' => $request['role_id'],
            'expired_date' => isset($request['expired_date']) && strlen($request['expired_date']) > 0 ? $request['expired_date'] : null ,
            'password' => Hash::make($request['password']),
        ]);
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
    public function show()
    {
        
        
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
        
        $validatepwd = strlen($request->password) > 0 ? 'required|string|min:8|confirmed' : '';

        $this->validate($request,
        [
            'name'      => 'required|string|max:191',
            'username'  => 'required|string|max:191',
            'email'     => 'required|string|email|max:191',
            'role_id'    => 'required|int',
            'password'  =>  $validatepwd
        ]);
        
        $update = User::findOrFail($request->id);
        $update->name = $request->name; 
        $update->username = $request->username; 
        $update->email = $request->email;
        $update->role_id = $request->role_id;
        if(strlen($request->password) > 0){
            $update->password = Hash::make($request->password);
        }
        if(strlen($request->expired_date) > 0){
            $update->expired_date = $request->expired_date;
        } 
        $update->save();
        //return ['message' => 'User is Updated'];
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
    public function destroy($id)
    {
        //
        $delete = User::findOrFail($id);
        $delete = $delete->delete();
        return response([
            'data' => $delete
        ],Response::HTTP_CREATED);
    }
    public function showmenu(){
        $datapages = DB::table('users')
        
        ->join('role_pages', 'role_pages.role_id', '=', 'user.role_id')
        ->join('pages', 'pages.id', '=', 'role_pages.page_id')
        ->select('pages.*')
        ->where('users.id',Auth::user()->id)
        //->where('pages.id','1')
        ->get();
   // dd($datapages); 

        return response([
            'data' => $datapages
        ],Response::HTTP_CREATED);
    }
}
