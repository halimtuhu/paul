<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use URL;

class LoginController extends Controller
{
    public function index(){
      $url = URL::previous();
      return view('auth.loginForm', compact('url'));
    }

    public function login(Request $input){
      $remember = false;
      if (isset($input->remember)) {
        $remember = true;
      }
      Sentinel::authenticate($input->all(), $remember);
      if(Sentinel::check()){
        if (strpos($input->redirect, 'login')) {
          return redirect('/');
        }
        return redirect($input->redirect);
      }else{
        return redirect('/login')->with(['info' => 'Login failed! Please check your email or password again.']);
      }
    }

    public function logout(){
      Sentinel::logout();
      return redirect()->back();
    }
}
