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
        'user_id', 'form_key', 'name','description','fields','columns_each_row', 'image', 'image_pos', 'hide','email','success_message','status'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
