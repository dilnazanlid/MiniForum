<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cookie;

trait checkTrait{

  public function checkCookieSet(){
    if(Cookie::get('auth')!==null){
      return false;
    }else{
      return true;
    }
  }

}

 ?>
