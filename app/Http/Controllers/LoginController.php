<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Sentinel;
use URL;
use Socialite;

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

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $reguler_user = User::where('email', $user->email)->get()->first();

        if($reguler_user){
          Sentinel::login($reguler_user);
          return redirect('/');
        }else{
          $timestamp = date('His');
          $user_credentials = [
            'username' => explode('@', $user->email)[0],
            'email' => $user->email,
            'password' => bcrypt(explode('@', $user->email)[0]),
            'full_name' => $user->name
          ];
          $new_user = Sentinel::registerAndActivate($user_credentials);
          $role = Sentinel::findRoleBySlug('user');
          $role->users()->attach($new_user);

          Sentinel::login($new_user);
          return redirect('/');
        }
    }
}
