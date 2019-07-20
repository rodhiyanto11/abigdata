<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use Illuminate\Support\Facades\Hash;
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
    public function index()
    {
        //
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
         
        ]);
        
        $data = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
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
        
        $validatepwd = strlen($request->password) > 0 ? 'required|string|min:8|confirmed' : '';
        
       
        $this->validate($request,
        [
            'name'      => 'required|string|max:191',
            'username'  => 'required|string|max:191',
            'email'     => 'required|string|email|max:191',
            'password'  =>  $validatepwd
        ]);
        
        $update = User::findOrFail($request->id);
        $update->name = $request->name; 
        $update->username = $request->username; 
        $update->email = $request->email;
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
        return ['message' => 'User deleted' ];
    }
}
