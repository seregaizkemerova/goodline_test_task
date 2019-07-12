<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
use Redirect;

class SocialAuthController extends Controller
{   
    
    public function socLogin()
    {
    	
    	// Get information about user.
    	$data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    	$user = json_decode($data, TRUE);
    	
    	$network = $user['network'];
    	
    	// Find user in DB.
    	$userData = User::where('email', $user['email'])->first();
    	
    	// Check exist user.
    	if (isset($userData->id)) {
    	
    		// Check user status.
    		if ($userData->exists) {
    	
    			// Make login user.
    			Auth::loginUsingId($userData->id, TRUE);
    			return redirect('/home');
    		}
    		// Wrong status.
    		else {
    			\Session::flash('flash_message_error', trans('interface.AccountNotActive'));
    			return view('/login');
    		}
    	}
    	// Make registration new user.
    	else {
    	
    		// Create new user in DB.
    		$newUser = User::create([
    				'name'   => $user['first_name'],
    				'email'  => $user['email'],
    				'email_verified_at' => date('Y-m-d H:i:s'),
    				'password' => Hash::make(str_random(8))
    				]);
    	
    		// Make login user.
    		Auth::loginUsingId($newUser->id, TRUE);
    	
    		\Session::flash('flash_message', trans('interface.ActivatedSuccess'));
    		return redirect('/home');
    	}
    	
    	
    }
}
