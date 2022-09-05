<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function admin(){
        echo 'welcome to admin';
        //add admin view files
    }
    public function vendor(){
        echo 'welcome to vendor';
        //add vendor view files
    }
    public function user(){
        echo 'welcome to user';
        //add user view files
    }
}
