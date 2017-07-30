<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class UserController extends Controller
{
    public function index(){
      return view('user.index');
    }
}
