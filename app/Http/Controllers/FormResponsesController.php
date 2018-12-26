<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\UserForm;
use App\UserFormResponse;
use App\UserFormEmailCollection;


class FormResponsesController extends Controller
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
		$pageData = ['title' => 'Form Response','description' => 'List','forms' => $forms];
		return view('Form.Response.list',$pageData);
	}

	public function responseEmailCollectionList(Request $request){
		$form = $form = Auth::user()->forms->where('form_key',$request->route('key'))->first();
		
		$pageData = ['title' => 'Email Collection','description' => 'List -'.$form->name,'collections' => $form->emailCollection];
		return view('Form.Response.emails',$pageData);
	}

	public function responseList(Request $request){
		$form = Auth::user()->forms->where('is_deleted',0)->where('form_key',$request->route('key'))->first();
		if(!$form)
			return view('Components.notfound');
		$form['fields_arr'] = ($form->fields) ? json_decode($form->fields,true) : [];


		$pageData = ['title' => 'Form Response','description' => 'List - '.$form->name,'form' => $form];
		return view('Form.Response.data',$pageData);
	}
	public function render(Request $request){
		$form = false;
		if($request->route('key'))
			$form = UserForm::where('form_key',$request->route('key'))->get()->first();		
		if(!$form)
			return view('Form.Render.notfound');
		if($form->is_deleted == 1 || $form->status == 0)
			return view('Form.Render.expired');

		$form['fields_arr'] = ($form->fields) ? json_decode($form->fields,true) : false;
		// echo "<pre>"; print_r($form); die;
		$pageData = ['title' => 'Form','form' => $form];
		return view('Form.Render.form',$pageData);
	}


	public static function generateField($key,$field){
		$fieldHtml = "";
		$fieldId = ($field['id']) ? $field['id'] : str_slug(str_random(5));
		$required = ($field['required'] == 1) ? ' vf-required ' : '' ;
		$requiredText = ($field['required'] == 1) ? " <small class='text-red'>*</small>" : '' ;
		$fieldHtml .= "<div class='form-group error-heading custom-file-input'>";
		$fieldHtml .= "<label for='{$fieldId}'>{$field['label']} {$requiredText} </label>";
		
		// Name Field
		if($field['fieldType'] == 1 ){ 
			$fieldHtml .= "<input name='{$key}' type='text' class='form-control {$required} {$field['fclass']}'  placeholder='{$field['placeholder']}' id='{$fieldId}'/>";
		}

		// Email Field
		elseif ($field['fieldType'] == 2 ) { 
			$fieldHtml .= "<input name='{$key}' type='email' class='form-control vf-email {$required} {$field['fclass']}'  placeholder='{$field['placeholder']}' id='{$fieldId}'/>";
		}

		//Phone Number Field
		elseif ($field['fieldType'] == 3 ) { 
			$fieldHtml .= "<input name='{$key}' type='tel' class='form-control vf-phone {$required} {$field['fclass']}'  placeholder='{$field['placeholder']}' id='{$fieldId}'/>";
		}

		// Textarea Field
		elseif ($field['fieldType'] == 4 ) { 
			$fieldHtml .= "<textarea name='{$key}' class='form-control {$required} {$field['fclass']}'  placeholder='{$field['placeholder']}' id='{$fieldId}'></textarea>";
		}

		// Drop Down Field
		elseif ($field['fieldType'] == 5 ) {
			$values = ($field['values']) ? explode(',', $field['values']) : [] ;
			$fieldHtml .= "<select name='{$key}' class='form-control {$required} {$field['fclass']}' id='{$fieldId}'>";
			for($s=0; $s<count($values); $s++) {
				$fieldHtml .= "<option value='{$values[$s]}'>{$values[$s]}</option>";
			}
			$fieldHtml .= "</select>";
		}

		// Radio Field
		elseif ($field['fieldType'] == 6 ) {
			$values = ($field['values']) ? explode(',', $field['values']) : [] ;
			for($s=0; $s<count($values); $s++) {
				$fieldHtml .= "<div class='row'><div class='col-md-12'>";
				$fieldHtml .= "<label><input type='radio' class='minimal {$required} {$field['fclass']}' name='{$key}' value='{$values[$s]}' /> &nbsp; {$values[$s]}</label>";
				$fieldHtml .= "</div></div>";
			}
		}

		// Checkbox Field
		elseif ($field['fieldType'] == 7 ) {
			$values = ($field['values']) ? explode(',', $field['values']) : [] ;
			for($s=0; $s<count($values); $s++) {
				$fieldHtml .= "<div class='row'><div class='col-md-12'>";
				$fieldHtml .= "<label><input type='checkbox' class='minimal {$required} {$field['fclass']}' name='{$key}[]' value='{$values[$s]}' /> &nbsp; {$values[$s]}</label>";
				$fieldHtml .= "</div></div>";
			}
		}

		// File Field
		elseif ($field['fieldType'] == 8 ||  $field['fieldType'] == 9) {
			$filter = ($field['fieldType'] == 8) ? "accept=image/*" : "" ;
			$fieldHtml .= "<label for='{$fieldId}' class='custom-file-label-before form-control'></label>";
			$fieldHtml .= "<input name='files[{$key}]' type='file' class='{$required} {$field['fclass']}'  placeholder='{$field['placeholder']}' id='{$fieldId}'/>";
		}		

		$fieldHtml .= "</div>";
		return $fieldHtml;
	}

	public function saveForm(Request $request){
		$formKey = $request->route('key');
		$fd = ($request->fd) ? json_decode($request->fd, true) : [];
		$fd=(!empty($fd)) ? array_filter($fd,function($arr){ return $arr['name'] != '_token'; }) : '' ;
		$formData = [];
		foreach ($fd as $fieldData) {
			$fname = str_replace("[]",'', $fieldData['name']);
			if(in_array($fname, array_keys($formData))){
				$formData[$fname] = $formData[$fname] .",".$fieldData['value'];
			}else{
				$formData[$fname] = $fieldData['value'];

			}
		}
		if($request->hasFile('files')):
			$files = $request->file('files');
			foreach ($files as $key => $file) {
				$filename = time().$file->getClientOriginalName();
				$file = Storage::disk('form_uploads')->putFileAs('',$file,$filename);
				$formData[$key] = Storage::disk('form_uploads')->url($file);
			}
		endif;
		$formResponse = [];
		$formResponse['form_key']=$formKey;
		$formResponse['data_key']=str_slug(str_random(16));
		$formResponse['data']=json_encode($formData);
		$formResponse['remote_address']= $_SERVER['REMOTE_ADDR'];
		if($response = UserFormResponse::create($formResponse)){
			$status = true;
			$message = $response->form->success_message;
		}else{
			$status = false;
			$message= "Something went wrong! Please try again."	;		
		}
		return response()->json(['status'=>$status,'message'=>$message]);
	}

	public function saveEmail(Request $request){
		$form = UserForm::where('form_key',$request->route('key'))->get()->first();
		$emailCollection = [];
		$emailCollection['user_id'] = $form->user_id;
		$emailCollection['form_key'] = $request->route('key');
		$emailCollection['email'] = $request->email;

		if ($request->has('name')) {
			$emailCollection['name'] = $request->name;
		}
		if($response = UserFormEmailCollection::create($emailCollection)){
			$status = true;
			$message = 'Email stored.';
		}else{
			$status = false;
			$message= "Something went wrong! Please try again."	;		
		}		

		return response()->json(['status'=>true,'message'=>$message]);
	}	


	public function getResponseChartData(Request $request){
		$form = UserForm::where('form_key',$request->route('key'))->get()->first();
		echo $totalRes = $form->responses->count();
		$chartField = json_decode($form->fields,true);
		$chartField = array_filter($chartField,function($arr){ return in_array($arr['fieldType'],[5,6,7]); });
		foreach ($chartField as $key => $field) {
			$options = ($field['values']) ? explode(',',$field['values']) : [];
			$options =  array_flip($options);
			$options = array_map(function($arr){return 0;}, $options);
			$chartField[$key]['options'] = $options;
		}
		echo "<pre>";
		print_r($chartField);
	}
}