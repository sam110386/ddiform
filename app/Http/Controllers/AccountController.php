<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
class AccountController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$profile = Auth::user();
		if(!$profile['avatar']){
			$profile['avatar'] = '/img/avatar5.png';
		}
		$pageData = ['title' => 'Dashboard','profile' => $profile];
		return view('Account.dashboard',$pageData);
	}


	public function view(){
		$profile = Auth::user();
		if(!$profile['avatar']){
			$profile['avatar'] = '/img/avatar5.png';
		}
		$pageData = ['title' => 'Profile', 'description'=>'', 'profile' => $profile];
		return view('Account.profile',$pageData);
	}

	public function updateProfile(Request $request){
		$valid = request()->validate([
			'name' => 'required',
			'phone' => 'nullable|numeric|digits_between:7,15',
			'avatar' => 'nullable|image|max:1024|dimensions:min_width=150,min_height=150|mimes:jpeg,png,gif'
		]);

		$uploadedFile = $request->file('avatar');
		if($uploadedFile && $uploadedFile->isValid()){
			$filename = time().$uploadedFile->getClientOriginalName();
			$file = Storage::disk('user_uploads')->putFileAs('',$uploadedFile,$filename);
			$user['avatar'] = Storage::disk('user_uploads')->url($file);
		}

		$user['name'] = $request->name;
		$user['phone'] = $request->phone;
		if(User::findOrFail(Auth::user()->id)->update($user)){
			$returnKey = 'success';
			$returnMsg = 'Profile has been updated.';
		}else{
			$returnKey = 'error';
			$returnMsg = 'Profile not updated.';            
		}
		return redirect()->back()->with($returnKey, $returnMsg);
	}


	public function updatePassword(Request $request){

		$validator = Validator::make($request->all(),
		 	[
		 		'old_password' => 'required|string',
		 		'new_password' => 'required|string|min:6|confirmed|different:old_password',
		 		'new_password_confirmation' => 'required|same:new_password'
			]
		);

		if(!Hash::check($request->old_password, Auth::user()->password)){
			$validator->getMessageBag()->add('old_password', 'Invalid Old Password');
			return back()->withErrors($validator)->withInput();
		}
		if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}
		$user['password'] = bcrypt($request->new_password);
		if(User::findOrFail(Auth::user()->id)->update($user)){
			$returnKey = 'success';
			$returnMsg = 'Password has been updated.';
		}else{
			$returnKey = 'error';
			$returnMsg = 'Password not updated.';            
		}
		return redirect()->back()->with($returnKey, $returnMsg);
	}
}