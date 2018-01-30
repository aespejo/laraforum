<?php

namespace App\Http\Controllers;


use Auth;
use App\User;
use SocialAuth;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    
     public function authenticate($provider)
    {
    	return SocialAuth::authorize($provider);
    }

    public function authenticate_callback($provider)
    {
    	try {
	        SocialAuth::login($provider, function($user, $details) {
	        	$userFound = User::where('email', $details->email)->first();
	        	if($userFound) {
	        		Auth::login($userFound);
	        	} else {
	        		$user->name 	= $details->full_name;	
		        	$user->email 	= $details->email;	
		        	$user->avatar 	= $details->avatar;	        	
		        	$user->save();
	        	}
	        });

	        
	    } catch (ApplicationRejectedException $e) {
	        // User rejected application
	        // return redirect('/home');
	    } catch (InvalidAuthorizationCodeException $e) {
	        // Authorization was attempted with invalid
	        // code,likely forgery attempt
	    }

	    return redirect('/forum');
    }
}
