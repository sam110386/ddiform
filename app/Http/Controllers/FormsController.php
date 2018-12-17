<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;

class FormsController extends Controller
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
		$forms = Auth::user()->forms;
		$pageData = ['title' => 'Forms','description' => 'List','forms' => $forms];
		return view('Form.list',$pageData);
	}


	public function edit(Request $request){
		$pageData = ['title' => 'Form'];
		return view('Form.form',$pageData);
	}

	public function save(Request $request){
		echo "<pre>";
		print_r($request->fields_json);
		echo "</pre>";
		$pageData = ['title' => 'Form'];
		return view('Form.form',$pageData);		
		/*die;
		$validator = Validator::make($request->all(),
			[
				'name' => 'required|string',
				'image' => 'nullable|image|max:1000|dimensions:min_width=150,min_height=150|mimes:jpeg,png,gif'
			]
		);
		if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}*/		
	}
	public function updateProfile(Request $request){
		$valid = request()->validate([
			'name' => 'required',
			'phone' => 'nullable|numeric|digits_between:7,15',
			'profile_picture' => 'nullable|image|max:1000|dimensions:min_width=150,min_height=150|mimes:jpeg,png,gif'
		]);

		$uploadedFile = $request->file('profile_picture');
		if($uploadedFile && $uploadedFile->isValid()){
			$filename = time().$uploadedFile->getClientOriginalName();
			$file = Storage::disk('user_uploads')->putFileAs('',$uploadedFile,$filename);
			$data['profile_picture'] = $file;
		}

		$data['name'] = $request->name;
		$data['phone'] = $request->phone;
		if(User::findOrFail(Auth::user()->id)->update($data)){
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
			return redirect('account/profile')->withErrors($validator)->withInput();
		}
		if ($validator->fails()) {
			return redirect('account/profile')->withErrors($validator)->withInput();
		}
		$data['password'] = bcrypt($request->new_password);
		if(User::findOrFail(Auth::user()->id)->update($data)){
			$returnKey = 'success';
			$returnMsg = 'Password has been updated.';
		}else{
			$returnKey = 'error';
			$returnMsg = 'Password not updated.';            
		}
		return redirect()->back()->with($returnKey, $returnMsg);
	}
}