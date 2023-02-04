<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('isAdmin');
    }

    protected function addUserView(){
        $outlets = Outlet::where('mode', 'public')->where('is_deleted',0)->get();
        return view('admin/user/addUser')->with(compact('outlets'));
    }
    protected function addUser(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
			'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'outlet_id' => ['required', 'numeric',  'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_user_view')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$user = new User;
                $user->name = $data['name'];
                $user->user_name = $data['user_name'];
                $user->outlet_id = $data['outlet_id'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->user_role = 'outlet user';
				$user->save();
				return redirect('add_user_view')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('add_user_view')->with('failed',"operation failed");
			}
		}
    }
    protected function userList(){
        //$users = User::where('user_role', 'outlate user')->get();


        $outlets = Outlet::where('mode', 'public')->get();
        $users = User::Join('outlets', 'users.outlet_id', '=', 'outlets.id')
        ->where('users.is_deleted', 0)
        ->where('user_role', 'outlet user')
        ->select('users.id','users.name', 'users.email','outlets.id as outlet_id', 'outlets.name as outlate_name', 'outlets.address')
        ->get();

        return view('admin/user/userList')->with(compact('users','outlets'));
    }




    protected function updateUser(Request $request){
        $rules = [
			'name' => ['required', 'string', 'max:255'],
            'outlet_id' => ['required', 'numeric'],
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->route('user_list')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$user = User::find($data['id']);
                $user->name = $data['name'];
                $user->outlet_id = $data['outlet_id'];
				$user->update();
				return redirect()->route('user_list')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->route('user_list')->with('failed',"operation failed");
			}
		}
    }

    protected function profile(){
        session()->put('verified', 0);
        return view('profile');
    }

    protected function profile1(){
        return view('profile');
    }

    protected function matchPassword(Request $request){
        $password = $request->old_password;
        if(Hash::check($password, auth()->user()->password)){
            session()->put('verified', 1);
            return redirect()->route('profile1');
        }
        else{
            session()->put('verified', 0);
            session()->flash('old_password', 'Password Incorrect');
            return redirect()->route('profile1');
        }
    }

    protected function updateUserInfo(Request $request){
        // $rules = [
        //     'name' => ['required', 'string', 'max:255'],
		// 	'user_name' => ['required', 'string', 'max:255', 'unique:users'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
		// ];

        if(auth()->user()->user_role == "Admin"){
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ];
        }else{
            $rules = ['user_name' => ['required', 'string', 'max:255', 'unique:users'],];
        }
        if($request->password != null && $request->password != ""){
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
        }

		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('profile1')
			->withInput()
			->withErrors($validator);
		}
		else{
            $user = User::where('id', auth()->user()->id)->first();

            $user->user_name = $request->user_name;
            if(auth()->user()->user_role == "Admin"){
                $user->name = $request->name;
                $user->email = $request->email;
            }
            if($request->password != null && $request->password != ""){
                $user->password = Hash::make($request->password);
            }
            $user->update();

            return redirect()->route('profile')->with('status',"Update successfully");
        }
    }
}
