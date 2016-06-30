<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use Auth;

use Redirect;

use Validator;

use App\Http\Requests;

use Illuminate\Foundation\Auth\User;

use DB;

use Hash;

class AdminController extends Controller
{
	public function startRegister() {
		$error = "";
		$data = array(
            	'error' => $error
            );
			return view('auth\register')->with($data);
	}
	public function registerProcessing(Request $request) {
		$rules = array(
		    'email'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|alphaNum|min:4' // password can only be alphanumeric and has to be greater than 3 characters
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
		    $error = "Invalid input !!!";
			$data = array(
	            	'error' => $error
	            );
			return view('auth\register')->with($data);
		}
		else {
			$userdata = array(
			        'email'     => $request->input('email'),
			        'password'  => $request->input('password')
		    	);
			$newAdmin = new User();
			$newAdmin->name = $request->input('name');
			$newAdmin->email = $request->input('email');
			$newAdmin->password = bcrypt($request->input('password'));
			$counter = sizeof(DB::table('users')->where('email','=', $newAdmin->email)->get());
			if ($counter != 0) {
				$error = "Email account existed !!!";
				$data = array(
	            	'error' => $error
	            );
				return view('auth\register')->with($data);
			}
			else {
				$newAdmin->save();
		    	if (Auth::attempt($userdata)) {

			        // validation successful!
			        // redirect them to the secure section or whatever
			        // return Redirect::to('secure');
			        // for now we'll just echo success (even though echoing in a controller is bad)
			        return Redirect::to('/show');

			    }
			}
		}
		
	}
	public function loginProcessing(Request $request) {
		$rules = array(
		    'email'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|alphaNum|min:4' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('login')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			$userdata = array(
		        'email'     => $request->input('email'),
		        'password'  => $request->input('password')
	    	);
	    	if (Auth::attempt($userdata)) {

		        // validation successful!
		        // redirect them to the secure section or whatever
		        // return Redirect::to('secure');
		        // for now we'll just echo success (even though echoing in a controller is bad)
		        return Redirect::to('/show');

		    } else {

		        // validation not successful, send back to form 
		        return Redirect::to('login');

		    }
		}
	}
    //
    public function logoutProcessing() {
    	Auth::logout();
    	return Redirect::to('login');
    }
}
