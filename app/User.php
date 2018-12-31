<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get the comments for the blog post.
     */
    public function forms()
    {
        return $this->hasMany('App\UserForm');
    }
    /**
     * Get the comments for the blog post.
     */
    public function templates()
    {
        return $this->hasMany('App\UserFormTemplate');
    } 

    /**
     * Get email collection for the form.
     */
    public function emailCollection()
    {
        return $this->hasMany('App\UserFormEmailCollection');
    }     

    /**
     * Get User Convert Kit credentials.
     */
    public function convertKit()
    {
        return $this->hasOne('App\UserConvertKit');
    }   
          
}
