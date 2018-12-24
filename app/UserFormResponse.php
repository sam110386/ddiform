<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormResponse extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_key', 'form_key', 'data','status','remote_address'
    ];


    /**
     * Get the post that owns the comment.
     */
    public function form()
    {
    	return $this->belongsTo('App\UserForm','form_key','form_key');
    }    
}
