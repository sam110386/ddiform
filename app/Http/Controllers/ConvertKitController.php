<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\UserConvertKit;

class ConvertKitController extends Controller
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

	}


	public function edit(){
		$credentials = UserConvertKit::where('user_id',Auth::user()->id)->first();
		$pageData = ['title' => 'Convertkit Integration', 'description'=>'Credentials', 'credentials' => $credentials];
		return view('Integration.convertkit',$pageData);
	}

	public function save(Request $request){
		$valid = request()->validate([
			'api_key' => 'required_with:api_secret',
			'api_secret' => 'required_with:api_key'
		]);

		$convertKit = UserConvertKit::updateOrCreate(['user_id' => Auth::user()->id], [ 
			'api_key' => $request->api_key, 'api_secret' => $request->api_secret
		]);
		if($convertKit){
			$returnKey = 'success';
			$returnMsg = 'Credentials has been updated.';
		}else{
			$returnKey = 'error';
			$returnMsg = 'Credentials not updated.';            
		}
		return redirect()->back()->with($returnKey, $returnMsg);
	}

}