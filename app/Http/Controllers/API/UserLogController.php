<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Fluent;
use App\Country;
use App\UserLogs;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Logs;
use Symfony\Component\HttpFoundation\Response;

class UserLogController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->search) && strlen($request->search) > 0 ){
            return UserLogs::latest()
                        ->where('username', 'ilike', '%' . $request->search . '%')
                        ->orWhere('page_name', 'ilike', '%' . $request->search . '%')
                        ->orWhere('country_name', 'ilike', '%' . $request->search . '%')
                        ->orWhere('city_name', 'ilike', '%' . $request->search . '%')
                        ->orWhere('region', 'ilike', '%' . $request->search . '%')
                        ->paginate(5);    
        }
        return UserLogs::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 


    public function store(Request $request)
    {
      //dd($request->json()->all());
       $logs = new Logs;
        $data = array(
           'user_id'       => Auth::user()->id,
           'user_name'     => Auth::user()->username,
           'page_id'       => $request->json('pageID'),
           'page_name'     => $request->json('pageName'),
           'action'        => $request->json('action'),
        );
        
        $return = $logs->store($data) ;
        return response([
            'data' => $return
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
    }
}
//https://itsolutionstuff.com/post/how-to-get-location-information-from-ip-address-in-laravel-example.html
