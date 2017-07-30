<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Sentinel;
use Activation;
use Mail;

class RegisterController extends Controller
{
    public function index(){
      return view('auth.registerForm');
    }

    public function register(Request $input){
      $findusername = User::where('username', $input->username)->get()->first();
      if ($findusername) {
        return redirect()->back()->with([
          "info" => "Username name has used by other user. Please type another username.",
          "type" => "danger"
        ]);
      }else{
        $user = Sentinel::register($input->all());
        $activation = Activation::create($user);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);
        $this->sendEmail($user, $activation->code);

        return redirect('/login')->with(['info' => 'We have send an activation code to your email. Please check your email to continue.']);
      }
    }

    private function sendEmail($user, $code){
      Mail::send('auth.sendActivationCode', [
        'user' => $user,
        'code' => $code
      ], function($message) use ($user){
        $message->from(env('MAIL_USERNAME'), 'Admin Paul');
        $message->to($user->email);
        $message->subject('Activation Code to Paul\'s Website');
      });
    }
}
