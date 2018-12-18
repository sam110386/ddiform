<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserForm;

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
		$form = new UserForm;
		if($request->route('key')){
			$form = UserForm::where('form_key',$request->route('key'))->get()->first();
		}
		$form['fields_arr'] = ($form->fields) ? json_decode($form->fields,true) : false;
		$pageData = ['title' => 'Form','form' => $form ];
		return view('Form.form',$pageData);
	}

	public function save(Request $request){
		$form = [];
		$form['name'] = $request->name;
		$form['description'] = $request->description;

		$form['columns_each_row'] = $request->columns_each_row;

		$form['image_pos'] = $request->image_pos;
		$form['hide'] = (isset($request->hide))  ? 1 : 0;
		$form['email'] = (isset($request->email))  ? 1 : 0;
		$form['success_message'] = $request->success_message;
		
		$uploadedFile = $request->file('image');
		if($uploadedFile && $uploadedFile->isValid()){
			$filename = time().$uploadedFile->getClientOriginalName();
			$file = Storage::disk('form_uploads')->putFileAs('',$uploadedFile,$filename);
			$form['image'] = Storage::disk('form_uploads')->url($file);
		}
		$fields = json_decode($request->fields_json,true);
		if($request->field_image_){
			foreach ($request->field_image_ as $key => $fieldImage) {
				$uploadedFile = $fieldImage;
				$filename = time().$uploadedFile->getClientOriginalName();
				$file = Storage::disk('form_uploads')->putFileAs('',$uploadedFile,$filename);
				$key = str_replace("'","", $key);
				$fields[$key]['image'] = Storage::disk('form_uploads')->url($file);
			}
		}
		$form['fields'] = json_encode($fields);
		if(!$request->route('key')){
			$form['user_id'] = Auth::user()->id; // Only if new form
			$form['form_key'] = str_slug(str_random(16)); // Only if new form
			if(UserForm::create($form)){
				$returnKey = 'success';
				$returnMsg = 'Form has been created.';
			}else{
				$returnKey = 'error';
				$returnMsg = 'Something went wrong.Please try again! Error: Form-3000';          
			}			
		}else{
			if(UserForm::where('form_key',$request->route('key'))->update($form)){
				$returnKey = 'success';
				$returnMsg = 'Form has been updated.';
			}else{
				$returnKey = 'error';
				$returnMsg = 'Something went wrong.Please try again! Error: Form-3001';
			}
		}		
		return redirect()->route('all-form')->with($returnKey, $returnMsg);	
	}


	public function updateStatus(Request $request){
		$form = ['status'=>$request->route('status')];
			// var_dump($request->route('status')); die;
		if(UserForm::where('form_key',$request->route('key'))->update($form)){
			$returnKey = 'success';
			$action  = ($request->route('status') == "1") ? "activated." : "deactivated.";
			$returnMsg = "Form has been $action";
		}else{
			$returnKey = 'error';
			$returnMsg = 'Something went wrong.Please try again! Error: Form-3002';
		}	
		return redirect()->route('all-form')->with($returnKey, $returnMsg);
	}
}