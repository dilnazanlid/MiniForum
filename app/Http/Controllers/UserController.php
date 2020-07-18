<?php

namespace App\Http\Controllers;

use App\User;
use App\Traits\checkTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    use checkTrait;

    public function SigninPage(){
      if(!$this->checkCookieSet()){
        return redirect()->route('dashboard');
      }else{
        return view('login');
      }
    }

    public function SignupPage(){
      if(!$this->checkCookieSet()){
        return redirect()->route('dashboard');
      }else{
        return view('signup');
      }
    }

    public function userSignUp(UserRequest $request){
      if(Cookie::get('auth')!==null){
        return redirect()->route('dashboard');
      }
      $user = new User();
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->username = $request['username'];
      $user->password =  bcrypt($request['password']);

      $user->save();

      Auth::login($user);
      $cookie = Cookie::make('auth', $request['username'], 120);

      return redirect()->route('dashboard')->withCookie($cookie);
    }

    public function userSignIn(Request $request){

      if(Auth::attempt(['username'=>$request['username'], 'password'=>$request['password']])){
        $cookie = Cookie::make('auth', $request['username'], 120);
        return redirect()->route('dashboard')->withCookie($cookie);
      }
      return redirect()->back()->with('wrong', 'Wrong username or password!');
    }

    public function Logout(){
      $cookie = Cookie::forget('auth');
      Auth::logout();
      return redirect()->route('main')->withCookie($cookie);
    }

}
