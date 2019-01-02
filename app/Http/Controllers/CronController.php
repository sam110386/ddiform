<?php

namespace App\Http\Controllers;
use App\UserFormEmailCollection;
use \Examinecom\ConvertKit\ConvertKit;

class CronController extends Controller
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

	public function processEmailsForConvertKit(){
		$emails = UserFormEmailCollection::where('cron',1)->where('status',0)->get();
		if(!$emails->count()){
			echo "No new record found.";
			die;
		}
		echo "CRON START";
		foreach ($emails as $email) {
			$name = $email->name;
			$emailId = $email->email;
			$formId = $email->form->convert_kit_form_id;
			$apiKey = $email->user->convertKit->api_key;
			$apiSecret = $email->user->convertKit->api_secret;

			echo "Name >>> " . $name;
			echo "<br>Email >>> " . $emailId;
			echo "<br>Form Id >>> " . $formId;

			if($formId && $apiKey && $apiSecret){
				$subscriber = ['first_name'=>$name,'email'=>$emailId];
				$convertClient =  new ConvertKit($apiKey,$apiSecret);
				$subs = $convertClient->forms()->subscribe($formId,$subscriber);
				if(isset($subs['subscription'])){
					$email->status = 1;
					$email->update();
					echo "<br>Success";
				}else{
					echo "<br>Failed";
				}
			}else{
				echo "<br>Failed";
			}
			echo "<br><<<<>>>><<<<>>>><<<<>>>><<<<>>>><<<<>>>><<<<>>>><br><br><br>";
		}
		echo "<br><br>CRON END";
		die;
	}
}