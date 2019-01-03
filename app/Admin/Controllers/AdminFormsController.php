<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Carbon\Carbon;
use App\UserForm;
use App\UserFormEmailCollection;
use App\UserFormResponse;

class AdminFormsController extends Controller{
	use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function formList(Content $content)
    {
        $forms = UserForm::where('is_deleted',0)->get();
        return $content
        ->header('Form')
        ->description('List')
        ->body(view('admin.user-form.list',['forms' => $forms]));
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function responseList(Request $request,Content $content)
    {
        if(!$request->route('key')){
            admin_error('Error','Missing Form key!');
            return redirect()->route('form-list');
        }
        
        $form = UserForm::where('form_key',$request->route('key'))->first();
        if(!$form){   
            admin_error('Error','Form not found!');
            return redirect()->route('form-list');
        }

        $form['fields_arr'] = ($form->fields) ? json_decode($form->fields,true) : [];

        $chartData = $this->getResponseChartData($request);

        $responses = UserFormResponse::where('form_key',$request->route('key'))->get();

        return $content
        ->header('Form Response')
        ->description('List')
        ->body(view('admin.user-form.responses',['form' => $form, 'chartData' => $chartData->original['data']]));
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function emailCollectionList(Request $request,Content $content)
    {
        $collections = UserFormEmailCollection::where('form_key',$request->route('key'))->get();
        return $content
        ->header('Email Collection')
        ->description('List')
        ->body(view('admin.user-form.emails',['collections' => $collections]));
    }

    public function getResponseChartData(Request $request){
        $form = UserForm::where('form_key',$request->route('key'))->get()->first();
        $responses = $form->responses; 
        $totalRes = count($responses);
        $chartField = json_decode($form->fields,true);
        $chartField = array_filter($chartField,function($arr){ return in_array($arr['fieldType'],[5,6,7]); });
        foreach ($chartField as $key => $field) {
            $options = ($field['values']) ? explode(',',$field['values']) : [];
            $options = array_map(function($arr){
                return trim($arr);  
            }, $options);            
            $options =  array_flip($options);
            $options = array_map(function($arr){return 0;}, $options);
            $chartField[$key]['options'] = $options;
        }
        $chartField = $this->processResponsesForChart($responses,$chartField);
        $chartData = $this->finalizeChartData($chartField,$totalRes);
        if($chartData){
            return response()->json(['status'=>true,'data'=>$chartData]);
        }else{
            return response()->json(['status'=>false,'message'=> "Somthing went wrong while preparing chart. Please try again."]);
        }
    }

    public function destroyForm(Request $request){
        echo 'her';
        $form = UserForm::where('form_key',$request->route('key'))->get()->first();
        $form['is_deleted'] = 1;
        if($form->update()){
            admin_success('Success','Form has been removed.');
        }else{
            admin_error('Error','Something went wrong.Please try again! Error: Form-3003');
        }
        return back();
    }

    public function updateFormStatus(Request $request){
        $form = ['status'=>$request->route('status')];
            // var_dump($request->route('status')); die;
        if(UserForm::where('form_key',$request->route('key'))->update($form)){
            $action  = ($request->route('status') == "1") ? "activated." : "deactivated.";
            admin_success('Success',"Form has been $action");
        }else{
            admin_error('Error','Something went wrong.Please try again! Error: Form-3002');
        }   
        return back();
    }

    public function processResponsesForChart($responses,$chartField){
        foreach ($responses as $response) {
            $responseData = json_decode($response->data,true);
            $chartField = $this->checkResponseForChart($responseData,$chartField);
        }
        return $chartField;
    }

    public function checkResponseForChart($response,$chartField){
        foreach ($response as $key => $value) {
            if(in_array($key, array_keys($chartField))){
                $chartField=$this->fetchChartValue($chartField,$key,$value);
            }
        }
        return $chartField;
    }

    public function fetchChartValue($chartField,$key,$value){
        if($chartField[$key]['fieldType']==7){
            $values = explode(',',$value);
            foreach ($values as $val) {
                $val = trim($val);
                $chartField[$key]['options'][$val]++;
            }   
        }else{
            $value = trim($value);
            $chartField[$key]['options'][$value]++;
        }
        return $chartField;
    }

    public  function finalizeChartData($chartField,$totalRes){
        $chartData =[];
        foreach ($chartField as $key => $value) {
            $chartData[$key]['label'] = $value['label'];
            $chartData[$key]['options'] =  array_map(function($val)use($totalRes){
                $percentage = (($val*100)/$totalRes);
                $percentage  = (is_float($percentage)) ? number_format((float)$percentage, 2, '.', '') : $percentage ;
                return $percentage;
            },
            $value['options']);
        }
        return $chartData;
    }


}