<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use App\User;
use App\UserForm;
use App\UserFormResponse;
class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(new InfoBox('Total Users', 'users', 'green', '/admin/users', number_format(User::count('id'),0,'',',')));
               });

                $row->column(4, function (Column $column) {
                    $column->append(new InfoBox('Total Forms', 'file', 'red', '/admin/forms', number_format(UserForm::count('id'),0,'',',')));
                });

                $row->column(4, function (Column $column) {
                    $column->append(new InfoBox('Total Form Responses', 'users', 'red', '/admin/forms', number_format(UserFormResponse::count('id'),0,'',',')));
                });
            });
    }
}
