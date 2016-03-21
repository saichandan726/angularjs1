<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e){
  return Redirect::route('internal.missing', array());
});

App::error(function(Exception $exception,$code)
{
   Log::error($exception);
   
      $data = array(
        'emails'       => 'hubbdevelopers@gotohubb.com',
        'exception'      => base64_encode($exception),     
        'errorCode'      => $code,       
        'sessionInfo'    => json_encode(Session::all())    
    );    
    if(Auth::check()){      
    //Fires the mail event 
    Event::fire('email.hubb.errors',array($data));   
  }
   
});