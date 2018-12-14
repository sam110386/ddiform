<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
