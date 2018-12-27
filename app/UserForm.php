<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'form_key', 'name','description','fields','columns_each_row', 'image', 'image_pos', 'hide','email','success_message','status','name_collection','email_collection','submit_text','email_collection_title','auto_response','is_deleted' ,'response_text'
    ];

    /**
     * Get the user that owns the form.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the template for the form.
     */
    public function template()
    {
        return $this->hasOne('App\UserFormTemplate');
    }

    /**
     * Get responses for the form.
     */
    public function responses()
    {
        return $this->hasMany('App\UserFormResponse','form_key','form_key');
    }

    /**
     * Get email collection for the form.
     */
    public function emailCollection()
    {
        return $this->hasMany('App\UserFormEmailCollection','form_key','form_key');
    }

}
