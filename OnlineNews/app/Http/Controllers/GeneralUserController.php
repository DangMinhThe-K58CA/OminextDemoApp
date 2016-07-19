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

class GeneralUserController extends Controller
{
	// public function registerProcessing(Request $request) {
	// 	$newUser = new User();
	// 	$newUser->username = $request->input('username');
	// 	$newUser->email = $request->input('email');
	// 	$query = DB::table('users')->where('email', '=', $newUser->email)->select('id')->get();
	// 	if (sizeof($query) != 0) {
	// 		// return redirect('/register',['error' => "Email đã tồn tại ! Vui lòng chọn email khác."]);
	// 	}
	// 	else {
	// 		$newUser->password = Hash::make($request->input('password'));
	// 		$newUser->gender = $request->input('gender');
	// 		$newUser->sortDescription = $request->input('review');
	// 		$newUser->dateOfBirth = $request->input('dateOfBirth');
	// 		$newUser->homeTown = $request->input('hometown');
	// 		$newUser->phone = $request->input('phone');
	// 		$newUser->hobbies = $request->input('hobbies');
	// 		$newUser->hobbies = $request->input('hobbies');
	// 		print_r($newUser);
	// 	}
	// }

	public function getHottestBookmarkList(Request $request) {
       if (Auth::check()) {
			$catesList = DB::table('categories')->get();
			$userId = Auth::user()->id;
			$catesListWithBookmark = DB::table('bookmarks')->join('newss', 'bookmarks.newsId', '=', 'newss.id')->join('categories', 'newss.cateId', '=', 'categories.id')->where('bookmarks.userId', '=', $userId)->orderBy('bookmarks.state', 'asc')->orderBy('bookmarks.updated_at', 'desc')->select('bookmarks.*','newss.*', 'newss.id as newsId')->take(10)->get();			
	    	// $bookmarksData = [];
	    	// for ($i = 0; $i < sizeof($catesList); $i ++) {
	    	// 	$cateData = [
	    	// 		'cateId' => $catesList[$i]->id,
	    	// 		'cateName' => $catesList[$i]->name,
	    	// 		'bookmarks' => []
	    	// 	];
	    	// 	for ($j = 0; $j < sizeof($catesListWithBookmark); $j ++) {
	    	// 		if ($catesList[$i]->id == $catesListWithBookmark[$j]->cateId) {
	    	// 			array_push($cateData['bookmarks'], $catesListWithBookmark[$j]);
	    	// 		}
	    	// 	}
	    	// 	array_push($bookmarksData, $cateData);
	    	//}
	    	for ($i = 0; $i < sizeof($catesListWithBookmark); $i ++) {
	    		$news = $catesListWithBookmark[$i];
	    		$imgsId = DB::table('newsImages')->where('newsId' , '=', $news->id)->get();
	    		for ($j = 0; $j < sizeof($imgsId); $j ++) {
	    			if ($j == 0) {
	    				$news->imagesList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
	    			}
	    			else {
	    				$tmpList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
	    				array_push($news->imagesList, $tmpList['0']);
	    			}
	    		}
	    	}
	    	$jsonData = json_encode($catesListWithBookmark);
	    	echo $jsonData;
		}
		else {
			return redirect('/');
		}
    }

	public function deleteNewsFromBookmark(Request $request) {
		if (Auth::check()) {
			$newsId = $request->input('newsId');
			$updated = DB::table('bookmarks')->where('userId', '=', Auth::user()->id)->where('newsId', '=', $newsId)->delete();
			if ($updated == 1) {
				echo 1;
			}
			else {
				echo -1;
			}
		}
		else {
			return redirect('/');
		}
	}

	public function readNewsInBookmark(Request $request) {
		if (Auth::check()) {
			$newsId = $request->input('newsId');
			$updated = DB::table('bookmarks')->where('userId', '=', Auth::user()->id)->where('newsId', '=', $newsId)->update(['state' => 1]);
			if ($updated == 1) {
				echo 1;
			}
			else {
				echo -1;
			}
		}
		else {
			return redirect('/');
		}
	}
	public function getCategoryWithBookmarkData(Request $request) {
		if (Auth::check()) {
			$catesList = DB::table('categories')->get();
			$userId = Auth::user()->id;
			$catesListWithBookmark = DB::table('bookmarks')->join('newss', 'bookmarks.newsId', '=', 'newss.id')->join('categories', 'newss.cateId', '=', 'categories.id')->where('bookmarks.userId', '=', $userId)->orderBy('bookmarks.state', 'asc')->orderBy('bookmarks.updated_at', 'desc')->get();			
	    	$bookmarksData = [];
	    	for ($i = 0; $i < sizeof($catesList); $i ++) {
	    		$cateData = [
	    			'cateId' => $catesList[$i]->id,
	    			'cateName' => $catesList[$i]->name,
	    			'bookmarks' => []
	    		];
	    		for ($j = 0; $j < sizeof($catesListWithBookmark); $j ++) {
	    			if ($catesList[$i]->id == $catesListWithBookmark[$j]->cateId) {
	    				array_push($cateData['bookmarks'], $catesListWithBookmark[$j]);
	    			}
	    		}
	    		array_push($bookmarksData, $cateData);
	    	}
	    	$jsonData = json_encode($bookmarksData);
	    	echo $jsonData;
		}
		else {
			return redirect('/');
		}
	}
	public function showProfile(Request $request) {
		if (Auth::check()) {
			$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
			if (sizeof($img) != 0) {
				$img = $img[0];
				if (Storage::disk('s3')->has($img->filename)) {
					$imgData = base64_encode(Storage::disk('s3')->get($img->filename));
					return view('front/generalProfile', ['imgData' => $imgData]);
				}
				else {
					return view('front/generalProfile', ['imgData', ""]);
				}
			}
		}
		else {
			return redirect('/')->with('error', 'Vui lòng đăng nhập !');
		}
	}
	//
	public function showInfo(Request $request) {
		if (Auth::check()) {
			$img = DB::table('fileentries')->where('id', '=', Auth::user()->imageId)->get();
			if (sizeof($img) != 0) {
				$img = $img[0];
				if (Storage::disk('s3')->has($img->filename)) {
					$imgData = base64_encode(Storage::disk('s3')->get($img->filename));
					return view('front/generalInfo', ['imgData' => $imgData]);
				}
				else {
					return view('front/generalInfo', ['imgData', ""]);
				}
			}
		}
		else {
			return redirect('/')->with('error', 'Vui lòng đăng nhập !');
		}
	}
    //
    public function loginProcessing(Request $request) {
    	if (sizeof($request->input()) == 0) {
			return Redirect::to('/');
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
	        return redirect('/');

	    } else {
	        // validation not successful, send back to form 
	        return redirect('/')->with('error', 'Email hoặc mật khẩu đăng nhập không đúng !');
	    }
    }
    //
    public function logout(Request $request) {
    	if (Auth::user()->admin == 0) {
	    	Auth::logout();
	    	return redirect('/');
	    }
	    elseif (Auth::user()->admin == 1) {
	    	return redirect('/cong-tac-vien');
	    }
	    else {
	    	return redirect('/quan-tri');
	    }
    }
    //
    public function changeGeneralProfile(Request $request) {
    	if (Auth::check()) {
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
			return redirect('/generalProfile')->with('success', 'Thay đổi thông tin thành công !');
		}
		else {
			return Redirect::to("/");
		}
    }
    //
    public function changePassword(Request $request) {
    	if (Auth::check()) {
			$curPas = $request->input('currentPassword');
			if (Hash::check($curPas, Auth::user()->password)) {
				$newPassword = Hash::make($request->input('newPassword'));
				if ($newPassword != Auth::user()->password) {
					DB::table('users')->where('id', Auth::user()->id)->update(['password' => $newPassword]);
					Auth::logout();
	    			return redirect('/')->with('success', "Thay đổi mật khẩu thành công ! Vui lòng đăng nhập lại !");
				}
			}
			else {
				 return redirect('/generalProfile')->with('error', 'Vui lòng nhập đúng mật khẩu hiện tại !');
			}
		}
		else {
			return Redirect::to('/');
		}
    }
}
