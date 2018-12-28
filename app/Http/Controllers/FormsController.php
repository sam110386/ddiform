<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserForm;
use App\UserFormTemplate;

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
		$forms = Auth::user()->forms->where('is_deleted',0);
		$pageData = ['title' => 'Forms','description' => 'List','forms' => $forms];
		return view('Form.list',$pageData);
	}
	public function listTemplates(){
		$templates = Auth::user()->templates;
		$pageData = ['title' => 'Template','description' => 'List','templates' => $templates];
		return view('Form.Template.list',$pageData);	
	}


	public function new(Request $request){
		$UserFormTemplates = Auth::user()->templates->where('status', 1);
		$pageData = ['title' => 'Form','description' => 'New','UserFormTemplates' => $UserFormTemplates];
		return view('Form.new',$pageData);
	}
	public function edit(Request $request){
		$form = new UserForm;
		if($request->route('key'))
			$form = UserForm::where('user_id',Auth::user()->id)->where('form_key',$request->route('key'))->where('is_deleted',0)->get()->first();
		
		if(!$form)
			return view('Components.notfound');
		$form['fields_arr'] = ($form->fields) ? json_decode($form->fields,true) : false;
		$pageData = ['title' => 'Form','form' => $form ];
		return view('Form.form',$pageData);
	}
	public function quickForm(Request $request){
		$route = 'new-form';
		$params= false;
		$returnKey = 'error';
		$returnMsg = 'Something went wrong.Please try again! Error: TemplateForm-4001';          
		$UserFormTemplate = UserFormTemplate::where('template_key',$request->route('key'))->first();
		if(!$UserFormTemplate){
			abort('404');
		}
		$formData = $UserFormTemplate->form;
		$form = [];
		$form['form_key'] = str_slug(str_random(16));
		$form['user_id'] = $formData['user_id'];

		$form['name'] = $formData['name'];
		$form['description'] = $formData['description'];
		$form['fields'] = $formData['fields'];
		$form['columns_each_row'] = $formData['columns_each_row'];
		$form['image'] = $formData['image'];
		$form['image_pos'] = $formData['image_pos'];
		$form['hide'] = $formData['hide'];
		$form['email'] = $formData['email'];
		$form['success_message'] = $formData['success_message'];
		$form['email_collection'] = $formData['email_collection'];
		$form['name_collection'] = $formData['name_collection'];	
		$form['submit_text'] = $formData['submit_text'];	
		$form['email_collection_title'] = $formData['email_collection_title'];	
		$form['auto_response'] = $formData['auto_response'];
		$form['response_text'] = $formData['response_text'];

		if($userForm  = UserForm::create($form)){
			$returnKey = 'success';
			$returnMsg = 'Form has been created.';
			$route = 'single-form';
			$params = ['key' => $form['form_key']];
		}
		return redirect()->route($route,$params)->with($returnKey, $returnMsg);
	}
	public function save(Request $request){
		$form = [];
		$form['name'] = $request->name;
		$form['description'] = $request->description;
		$form['columns_each_row'] = $request->columns_each_row;
		$form['image_pos'] = $request->image_pos;
		$form['hide'] = (isset($request->hide))  ? 1 : 0;
		$form['email'] = (isset($request->email))  ? 1 : 0;
		$form['email_collection'] = (isset($request->email_collection))  ? 1 : 0;
		$form['name_collection'] = (isset($request->name_collection))  ? 1 : 0;
		$form['success_message'] = $request->success_message;
		$form['submit_text'] = $request->submit_text;
		$form['email_collection_title'] = $request->email_collection_title;	
		$form['auto_response'] = (isset($request->auto_response))  ? 1 : 0;
		$form['response_text'] = $request->response_text;
		if($request->form_image_opt == 'yes' && $request->hasFile('image')){
			$uploadedFile = $request->file('image');
			if($uploadedFile && $request->form_image_opt == 'yes' && $uploadedFile->isValid()){
				$filename = time().$uploadedFile->getClientOriginalName();
				$file = Storage::disk('form_uploads')->putFileAs('',$uploadedFile,$filename);
				$form['image'] = Storage::disk('form_uploads')->url($file);
			}
		}else{
			$form['image'] = "";
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
			if($userForm  = UserForm::create($form)){
				$formId= $userForm->id; 
				$returnKey = 'success';
				$returnMsg = 'Form has been created.';
			}else{
				$returnKey = 'error';
				$returnMsg = 'Something went wrong.Please try again! Error: Form-3000';          
			}			
		}else{
			$userForm = UserForm::where('form_key',$request->route('key'))->first();
			$formId = $userForm->id;
			if($userForm->update($form)){
				$returnKey = 'success';
				$returnMsg = 'Form has been updated.';
			}else{
				$returnKey = 'error';
				$returnMsg = 'Something went wrong.Please try again! Error: Form-3001';
			}
		}
		if($formId && isset($request->saveformtemplate)){
			$UserFormTemplate = UserFormTemplate::firstOrNew(['form_id' => $formId]);
			$UserFormTemplate->user_id = $userForm->user_id;
			$UserFormTemplate->name = $request->name;
			$UserFormTemplate->template_key = str_slug(str_random(10));
			$UserFormTemplate->save();
		}	
		return redirect()->route('all-forms')->with($returnKey, $returnMsg);	
	}
	public function destroy(Request $request){
		$form = UserForm::where('form_key',$request->route('key'))->get()->first();
		if(!$form)
			return view('Components.notfound');
		$form['is_deleted'] = 1;
		if($form->update()){
			$returnKey = 'success';
			$returnMsg = 'Form has been removed.';
		}else{
			$returnKey = 'error';
			$returnMsg = 'Something went wrong.Please try again! Error: Form-3003';
		}
		return redirect()->route('all-forms')->with($returnKey, $returnMsg);
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
		return redirect()->route('all-forms')->with($returnKey, $returnMsg);
	}

	public function updateTemplateStatus(Request $request){
		$form = ['status'=>$request->route('status')];

		if(UserFormTemplate::where('template_key',$request->route('key'))->update($form)){
			$returnKey = 'success';
			$action  = ($request->route('status') == "1") ? "activated." : "deactivated.";
			$returnMsg = "Template has been $action";
		}else{
			$returnKey = 'error';
			$returnMsg = 'Something went wrong.Please try again! Error: Template-4002';
		}	
		return redirect()->route('all-form-templates')->with($returnKey, $returnMsg);
	}

}