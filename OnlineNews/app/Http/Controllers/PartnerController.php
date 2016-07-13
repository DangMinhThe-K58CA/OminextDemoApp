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

use App\Fileentry;
 
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Response;


class PartnerController extends Controller
{
	public function saveNewsContent(Request $request) {
		$content = $request->input('editor');
		print_r($content);
	}
	
	public function checkRole() {
		if(Auth::check()) {
				if (Auth::user()->admin == 1) {
					return 1;
				}
				else {
					return 0;
				}
			}
			else {
					return 0;
				}
	}

	public function index() {
		if ($this->checkRole()) {
				return view('partner/index');
		}
		else {
			return view('partner/Login', ['error' => ""]);
		}
	}


	public function changeInfo(Request $request) {
		if ($this->checkRole()) {
			$tmpAdmin = new User();
			$tmpAdmin->name = $request->input('name');
			$tmpAdmin->sortDescription = $request->input('sortDescription');
			$tmpAdmin->homeTown = $request->input('homeTown');
			$tmpAdmin->dateOfBirth = $request->input('dateOfBirth');
			$tmpAdmin->phone = $request->input('phone');
			if ($tmpAdmin->name != "") {
				DB::table('users')->where('id', Auth::user()->id)->update(['name' => $tmpAdmin->name]);
			}
			if ($tmpAdmin->sortDescription != Auth::user()->sortDescription) {
				DB::table('users')->where('id', Auth::user()->id)->update(['sortDescription' => $tmpAdmin->sortDescription]);
			}
			if ($tmpAdmin->homeTown != "") {
				DB::table('users')->where('id', Auth::user()->id)->update(['homeTown' => $tmpAdmin->homeTown]);
			}
			if ($tmpAdmin->dateOfBirth != "") {
				DB::table('users')->where('id', Auth::user()->id)->update(['dateOfBirth' => $tmpAdmin->dateOfBirth]);
			}
			if ($tmpAdmin->phone != "") {
				DB::table('users')->where('id', Auth::user()->id)->update(['phone' => $tmpAdmin->phone]);
			}
			return redirect('/partnerProfile')->with('success', 'Thay đổi thông tin thành công !');
		}
		else {
			return Redirect::to("/");
		}
	}

	public function changePassword(Request $request) {
		if ($this->checkRole()) {
			$curPas = $request->input('currentPassword');
			if (Hash::check($curPas, Auth::user()->password)) {
				$newPassword = Hash::make($request->input('newPassword'));
				if ($newPassword != Auth::user()->password) {
					DB::table('users')->where('id', Auth::user()->id)->update(['password' => $newPassword]);
					Auth::logout();
	    			return view('partner/login',['error' => ""]);
				}
			}
			else {
				 return redirect('/partnerProfile')->with('error', 'Vui lòng nhập đúng mật khẩu hiện tại !');
			}
		}
		else {
			return Redirect::to('/');
		}
		
	}

	public function showProfile() {
		if ($this->checkRole()) {
			$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
			if (sizeof($img) != 0) {
				$img = $img[0];
				if (Storage::disk('s3')->has($img->filename)) {
					$imgData = base64_encode(Storage::disk('s3')->get($img->filename));
					return view('partner/partnerProfile', ['imgData' => $imgData]);
				}
				else {
					return view('partner/partnerProfile', ['imgData' => ""]);
				}
			}
		}
		else {
			return view('partner/login', ['error' => ""]);
		}
	}


	public function loginProcessing(Request $request) {
		if (sizeof($request->input()) == 0) {
			return view('partner/login', ['error' => ""]);
		}
		else {
			$userdata = array(
		        'email'     => $request->input('email'),
		        'password'  => $request->input('password')
	    	);

	    	if (Auth::attempt($userdata)) {

		        // validation successful!
		        // redirect them to the secure section or whatever
		        // return Redirect::to('secure');
		        // for now we'll just echo success (even though echoing in a controller is bad)
		        if (Auth::user()->admin == 1) {
		        	return redirect('/cong-tac-vien');
		        }
		        else {
		        	return redirect('/');
		        }
		    }
		    else {
		    	return view('partner/login', ['error' => "1"]);
		    }
		}
	}
    //
    public function logoutProcessing() {
    	if ($this->checkRole()) {
	    	Auth::logout();
	    	return view('partner/login', ['error' => ""]);
	    }
	    else {
	    	return Redirect::to('/');
	    }
    }
}
