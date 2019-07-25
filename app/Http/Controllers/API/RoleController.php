<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

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
        //
      //  dd(1);
      if(isset($request->req) &&  $request->req == 'all'){
          //dd(1);
          return ['data'=> Role::all()];
      }else{
        return Role::latest()->paginate(10);
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
            'name'      => 'required|string|max:191',
           
        ]);
        
        $data = Role::create([
            'name' => $request['name'],
            'note' => $request['note'],
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
    public function destroy($id)
    {
        //
        $delete = Role::findOrFail($id);
        $delete = $delete->delete();
        return response([
            'data' => $delete
        ],Response::HTTP_CREATED);
    }
}
