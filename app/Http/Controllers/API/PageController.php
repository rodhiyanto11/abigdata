<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Page;
use App\RolePage;
use Illuminate\Support\Facades\DB;
class PageController extends Controller
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
        //dd($request->search);
        if(isset($request->req) && $request->req == 'all'){
            return ['data'=> Page::all()];
        }
        if(isset($request->req) && $request->req == 'role'){
            if(isset($request->id)){
               // dd($request->id);
               $data = DB::table('role_pages')
               ->where('role_pages.role_id',$request->id)
               ->select('role_pages.*')
               ->get();
              // dd($data);
                return ['data'=> $data];
                    
                
            }
        }
        if(isset($request->search)){
            //dd(2);
            return Page::latest()
                        ->where('name', 'ilike', '%' . $request->search . '%')
                        ->paginate(100);
        }
        return Page::latest()->paginate(100);
        
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
            'model'     => 'required|string|max:191',
            'controller'=> 'required|string|max:191',
            'routename'=> 'required|string|max:191',
            'status'    => 'required|integer',
            'view'      => 'string|max:191',
            
        ]);
       
        $data = Page::create([
            'name' => ucwords(strtolower($request['name'])),
            'model' =>  ucwords(strtolower($request['model'])),
            'controller' => $request['controller'],
            'routename' => $request['routename'],
            'status' => $request['status'],
            'view' => $request['view'],
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
       //
      
       $this->validate($request,
       [
           'name'      => 'required|string|max:191',
           'model'     => 'required|string|max:191',
           'controller'=> 'required|string|max:191',
           'routename'=> 'required|string|max:191',
           'status'    => 'required|integer',
           'view'      => 'string|max:191',
          
       ]);
       
       $update = Page::findOrFail($id);
    
       $update->name            = ucwords(strtolower($request->name));
       $update->model           = ucwords(strtolower($request->model));
       $update->controller      = $request->controller;
       $update->routename       = $request->routename;
       $update->status          = $request->status;
       $update->note            = $request->note;
       $update->save();

       return response([
           'data' => $update
       ],Response::HTTP_CREATED);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         //
         $delete = Page::findOrFail($id);
         $delete = $delete->delete();
         return response([
             'data' => $delete
         ],Response::HTTP_CREATED);
    }
}
