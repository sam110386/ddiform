<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Carbon\Carbon;
use App\User;
class AdminUsersController extends Controller{
	use HasResourceActions;
    
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function userList(Content $content)
    {
        $users = User::all();
        return $content
            ->header('User')
            ->description('List')
            ->body(view('admin.user.list',['users' => $users]));
    }

}