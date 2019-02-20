<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserFormEmailCollection;
use \Examinecom\ConvertKit\ConvertKit;
class UserConvertKit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'api_key', 'api_secret'
    ];

    /**
     * Get the user that owns the form.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public static function processEmailsForConvertKit(){
        $emails = UserFormEmailCollection::where('cron',1)->where('status',0)->get();
        if(!$emails->count()){
            //echo "No new record found.";
            exit;
        }
        //echo "CRON START";
        foreach ($emails as $email) {
            $name = $email->name;
            $emailId = $email->email;
            $formId = $email->form->convert_kit_form_id;
            $apiKey = $email->user->convertKit->api_key;
            $apiSecret = $email->user->convertKit->api_secret;

            if($formId && $apiKey && $apiSecret){
                $subscriber = ['first_name'=>$name,'email'=>$emailId];
                $convertClient =  new ConvertKit($apiKey,$apiSecret);
                $subs = $convertClient->forms()->subscribe($formId,$subscriber);
                if(isset($subs['subscription'])){
                    $email->status = 1;
                    $email->update();
                    //echo "\nSuccess";
                }else{
                    //echo "\n inner Failed";
                }
            }else{
                //echo "\n Failed";
            }
            //echo "\n <<<<>>>><<<<>>>><<<<>>>><<<<>>>><<<<>>>><<<<>>>>\n ";
        }
        //echo "\n CRON END";
        exit;
    }

}
