<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use App\UserRole;
use App\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use App\Libraries\Logs;
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
    public function logs($attribute){
        // $logs = new Logs;
        // $data = array(
        //    'user_id'       => Auth::user()->id,
        //    'user_name'     => Auth::user()->username,
        //    'page_id'       => ,
        //    'page_name'     => 4,
        //    'action'        => 5,
        // );
    }
    public function index(Request $request)
    {
       
        if(isset($request->getprofile) && $request->getprofile == true){
            return ['data' => auth('api')->user() ];
        }
        if(isset($request->req) &&  $request->req == 'menu'){
            return $this->showmenu();
        }
        if(isset($request->req) &&  $request->req == 'update' && isset($request->id)){
          // dd(auth('api')->user()->id);
            $update          = User::where('id', auth('api')->user()->id)->firstOrFail();
            //dd($update);
            $update->role_id = $request->id; 
            $update->save();
            return response([
                'data' => $update
            ],Response::HTTP_CREATED);
        }
        if(isset($request->search) && strlen($request->search) > 0 ){
            return User::latest()
                        ->where('username', 'ilike', '%' . $request->search . '%')
                        ->orWhere('name', 'ilike', '%' . $request->search . '%')
                        ->orWhere('email', 'ilike', '%' . $request->search . '%')
                        ->paginate(5);    
        }
        return User::latest()->paginate(5);
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
            //'role_id'  =>  'required|int',
            'is_expired'  =>  'required|int',
         
        ]);
        
        $data = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'status' => 2,
            'is_expired' => $request['is_expired'], 
            //'role_id' => $request['role_id'],
            'photo' => '1567588707.png',
            'expired_date' => isset($request['expired_date']) && strlen($request['expired_date']) > 0 ? $request['expired_date'] : null ,
            'password' => bcrypt($request['password']),
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
        //dd($request->photo);
        $user = auth('api')->user();
        $update = User::findOrFail($request->id);
        $userdata = User::where('id',$request->id)->first();
        $validatepwd = strlen($request->password) > 0  ||  $userdata->status == 2 ? 'required|string|min:8|confirmed' : '';
        
        $this->validate($request,
        [
            'name'      => 'required|string|max:191',
            'username'  => 'required|string|max:191',
            'email'     => 'required|string|email|max:191',
           // 'is_expired'     => 'required|int',
            //'role_id'    => 'required|int',
            'password'  =>  $validatepwd
        ]);

       // dd($validatepwd);
        // return response([
        //     'data' => $userdata,
        //     'v' => $validatepwd
        // ],Response::HTTP_NOT_FOUND);
       
        //dd($userdata);
        $update->name = $request->name; 
        $update->username = $request->username; 
        $update->email = $request->email;
        $update->is_expired = $request->is_expired;

        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto && $request->photo){
            $name = time().'.' .explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->resize(300, 300)->save(public_path('img/profile/').$name);

            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if (file_exists($userPhoto)) {

                @unlink($userPhoto);
            }
            
            $update->photo = $request->photo;
        }
        // dd($request->photo);
        
        if(isset($request->role_id) && strlen($request->role_id )){
            $update->role_id = $request->role_id;
        }
        
        if(strlen($request->password) > 0  && $userdata->status == 2){
            $update->password = 1;
            $update->password = bcrypt::make($request->password);
        }
        if(strlen($request->password) > 0  && $userdata->status != 2){
           // $update->password = 1;
            $update->password = bcrypt::make($request->password);
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
        
        $first_role = UserRole::where('user_id',auth('api')->user()->id)->first();
       
        $datapages = DB::table('users')
        ->join('role_pages', 'role_pages.role_id', '=', 'users.role_id')
        ->join('pages', 'pages.id', '=', 'role_pages.page_id')
        ->select('pages.*')
        ->where('users.id',auth('api')->user()->id)
        ->where('pages.status','<>',5)
        ->get();
       

        return response([
            'data' => $datapages
        ],Response::HTTP_CREATED);
    }
}
