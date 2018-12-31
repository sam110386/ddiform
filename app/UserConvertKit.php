<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
