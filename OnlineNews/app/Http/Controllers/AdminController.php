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


class AdminController extends Controller
{
	
	public function checkRole() {
		if(Auth::check()) {
				if (Auth::user()->admin == 2) {
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

	public function changeRole(Request $request) {
		if ($this->checkRole()) {
			$userId = $request->input('userId');
			$newRole = $request->input('newRole');
			$changed = DB::table('users')->where('id', '=', $userId)->update(['admin' => $newRole]);
			echo $changed;
		}
		else {
			return Redirect::to('/');
		}
	}

	public function changeAdminInfo(Request $request) {
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
			return redirect('/yourProfile')->with('success', 'Thay đổi thông tin thành công !');
		}
		else {
			return Redirect::to('/');
		}
	}

	public function changeAdminPassword(Request $request) {
		if ($this->checkRole()) {
			$curPas = $request->input('currentPassword');
			if (Hash::check($curPas, Auth::user()->password)) {
				$newPassword = Hash::make($request->input('newPassword'));
				if ($newPassword != Auth::user()->password) {
					DB::table('users')->where('id', Auth::user()->id)->update(['password' => $newPassword]);
					return Redirect::to('/adminLogout');
				}
			}
			else {
				return redirect('/yourProfile')->with('error', 'Vui lòng nhập đúng mật khẩu hiện tại !');
			}
		}
		else {
			return Redirect::to('/');
		}
		
	}

	public function showAdminProfile() {
		if ($this->checkRole()) {
			$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
			if (sizeof($img) != 0) {
				$img = $img[0];
				if (Storage::disk('s3')->has($img->filename)) {
					$imgData = base64_encode(Storage::disk('s3')->get($img->filename));
					return view('admin/adminProfile', ['imgData' => $imgData]);
				}
				else {
					return view('admin/adminProfile', ['imgData', ""]);
				}
			}
		}
		else {
			return redirect('/adminLogin')->with('error', 'Vui lòng đăng nhập bằng tài khoản quản trị viên !');
		}
	}

	public function showAdminsList() {
		if ($this->checkRole()) {
			$adminsList = DB::table('users')->where('admin', '=', 2)->paginate(6);
			return view('admin/adminsList', ['admins' => $adminsList]);
		}
		else {
			return Redirect::to('/');
		}
	}

	public function showPartnersList() {
		if ($this->checkRole()) {
			$partnersList = DB::table('users')->where('admin', '=', 1)->paginate(6);
			return view('admin/partnersList', ['partners' => $partnersList]);
		}
		else {
			return Redirect::to('/');
		}
	}

	public function showViewersList() {
		if ($this->checkRole()) {
			$viewersList = DB::table('users')->where('admin', '=', 0)->paginate(6);
			return view('admin/viewersList', ['viewers' => $viewersList]);
		}
		else {
			return Redirect::to('/');
		}
	}

	public function index() {
		if ($this->checkRole()) {
			return view('admin/adminHomePage');
		}
		elseif (Auth::user()->admin == 1) {
			return Redirect::to('/cong-tac-vien');
		} 
		
	}

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
			$newAdmin->password = Hash::make($request->input('password'));
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
			        return Redirect::to('/');

			    }
			}
		}
	}
	public function loginProcessing(Request $request) {
		if (sizeof($request->input()) == 0) {
			return Redirect::to('/adminLogin');
		}
		$userdata = array(
		        'email'     => $request->input('email'),
		        'password'  => $request->input('password')
	    	);
    	if (Auth::attempt($userdata)) {

	        // validation successful!
	        // redirect them to the secure section or whatever
	        // return Redirect::to('secure');
	        // for now we'll just echo success (even though echoing in a controller is bad)
	        if (Auth::user()->admin == 2) {
	        	return Redirect::to('/quan-tri');
	        }
	        elseif (Auth::user()->admin == 1) {
	        	return Redirect::to('/cong-tac-vien');
	        }
	        else {
		        return Redirect::to('/');
	        }

	    } else {

	        // validation not successful, send back to form 
	        return redirect('/adminLogin')->with('error', 'Email hoặc mật khẩu đăng nhập không đúng !');

	    }
	}
    //
    public function logoutProcessing() {
    	if ($this->checkRole()) {
	    	Auth::logout();
	    	return redirect('/adminLogin')->with('error', 'Vui lòng nhập lại !');
	    }
	    else {
	    	return Redirect::to('/adminLogin');
	    }
    }
}
