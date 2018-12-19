<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormTemplate extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'form_id', 'name','status'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the post that owns the comment.
     */
    public function form()
    {
    	return $this->belongsTo('App\UserForm');
    }    
}
