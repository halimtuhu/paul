<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\User;

class ActivationController extends Controller
{
    public function activate($userid, $code){
      $user = Sentinel::findById($userid);

      if(Activation::complete($user, $code)){
        return redirect('/login')->with(['info' => 'Your account has been activated. Now you can login with your account.']);
      }else{
        return redirect('/login')->with(['info' => 'Look like there is something wrong happen. Please contact the admin.']);
      }
    }
}
