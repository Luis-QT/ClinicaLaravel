<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use App\User as User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
       $users = User::all();
       $valida = false;
       foreach ($users as $user) {
         if($user->email == $request->email && Hash::check($request->password,$user->password)){
           Auth::loginUsingId($user->id);
           $valida = true;
           break;
         }
       }
       if($valida){
         return redirect()->intended('/home');
       }else{
         return view('auth.login');
       }
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
   }

    // public function __construct(Request $request)
    // {
    //    $this->middleware('guest', ['except' => 'logout']);
    // }

}
