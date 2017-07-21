<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use Mail;

class RegisterController extends Controller
{
    public function index(){
      return view('auth.registerForm');
    }

    public function register(Request $input){
      $user = Sentinel::register($input->all());
      $activation = Activation::create($user);
      $role = Sentinel::findRoleBySlug('admin');
      $role->users()->attach($user);
      $this->sendEmail($user, $activation->code);

      return redirect('/login')->with(['info' => 'We have send an activation code to your email. Please check your email to continue.']);
    }

    private function sendEmail($user, $code){
      Mail::send('auth.sendActivationCode', [
        'user' => $user,
        'code' => $code
      ], function($message) use ($user){
        $message->to($user->email);
        $message->subject('Activation Code to Paul\'s Website');
      });
    }
}
