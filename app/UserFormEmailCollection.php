<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormEmailCollection extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'form_key', 'name','email'
    ];


    /**
     * Get the post that owns the comment.
     */
    public function form()
    {
    	return $this->belongsTo('App\UserForm','form_key','form_key');
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }    
}
