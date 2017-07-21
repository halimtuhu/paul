<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function index(){
      return view('auth.loginForm');
    }

    public function login(Request $input){
      $remember = false;
      if (isset($input->remember)) {
        $remember = true;
      }
      Sentinel::authenticate($input->all(), $remember);
      if(Sentinel::check()){
        if(Sentinel::getUser()->roles()->first()->slug == 'admin'){
          return redirect('/admin-paul');
        }else{
          return redirect('/');
        }
      }else{
        return redirect('/login')->with(['info' => 'Login failed! Please check your email or password again.']);
      }
    }

    public function logout(){
      Sentinel::logout();
      return redirect('/');
    }
}
