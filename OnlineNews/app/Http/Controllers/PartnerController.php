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

use App\News;
 
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Response;


class PartnerController extends Controller
{
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
	public function editNews($newsId = 0) {
		if (Auth::check()) {
			$news = DB::table('newss')->where('id', '=', $newsId)->get();
			if (Auth::user()->id != $news[0]->authId) {
				return Redirect::to('/cong-tac-vien');
			}
			else {
				if (sizeof($news) != 0) {
					//var_dump($news);
					return view('partner/editNews', ['news' => $news[0]]);
				}
				else {
					return Redirect::to('/');
				}
			}
		}
		else {
			return Redirect::to('/');
		}
	}
	public function completeEditingNews(Request $request) {
		if ($this->checkRole()) {
			// $newsId = $request->input('newsId');
			// $title = $request->input('newsTitle');
			// $tmpList = DB::table('newss')->where('title','=', $title)->select('id')->get();
			// if (sizeof($tmpList) == 1) {
			if (1) {
				// echo(sizeof($tmpList));
				$newsId = $request->input('newsId');
				$query = DB::table('newss')->where('id','=', $newsId)->get();
				$curNews = $query[0];
				$newsTitle = $request->input('newsTitle');
				$cateId = $request->input('cateId');
				$shortDescription = $request->input('shortDescription');
				$content = $request->input('content');

				if ($cateId != $curNews->cateId) {
					DB::table('newss')->where('id', '=', $newsId)->update(['cateId' => $cateId]);
				}
				if ($newsTitle != $curNews->title) {
					DB::table('newss')->where('id', '=', $newsId)->update(['title' => $newsTitle]);
				}
				if ($shortDescription != $curNews->shortDescription) {
					DB::table('newss')->where('id', '=', $newsId)->update(['shortDescription' => $shortDescription]);
				}
				if ($content != $curNews->content) {
					DB::table('newss')->where('id', '=', $newsId)->update(['content' => $content]);
				}
				//
				$newId = $newsId;
				$tmpContent = $content;
				$firstImageTag = strpos($tmpContent, "<img");
				//
				$firstImgString = substr($tmpContent, $firstImageTag);
				$firstImageEndTag = strpos($firstImgString, "/>");
				$firstImgString = substr($firstImgString,0, $firstImageEndTag + 2);
				//
				$firstSrcTag = strpos($tmpContent, "src=");
				//
				$firstImgString = substr($tmpContent, $firstSrcTag + 5);
				$firstSrcPp = strpos($firstImgString, "\"");
				$firstImgString = substr($firstImgString, 0, $firstSrcPp);
				//
				$img = strrev($firstImgString);
				$firstSignal = strpos($img, '/');
				$img = strrev(substr($img, 0, $firstSignal));
				//
				DB::table('images')->insert([
						'name' => $img
					]);
				DB::table('newsimages')->where('newsId', '=', $newsId)->delete();
				$imageId = DB::table('images')->max('id');
				DB::table('newsimages')->insert([
						'newsId' => $newId,
						'imageId' => $imageId
					]);
				echo 1;
			} else {
				echo "Tiêu đề trùng ! Vui lòng chọn tiêu đề khác.";
			}
			
		} else {
			return redirect('/');
		}
	}
	public function deleteNews(Request $request) {
		if (Auth::check()) {
			$newsId = $request->input('newsId');
			$deleted = DB::table('newss')->where('id', '=', $newsId)->delete();
			echo $deleted;
		}
		else {
			return Redirect::to('/');
		}
	}
	public function newssListManage(Request $request) {
		if ($this->checkRole()) {
			$userId = Auth::user()->id;
			$newssList = DB::table('newss')->join('users', 'newss.authId', '=', 'users.id')->join('categories', 'newss.cateId', '=', 'categories.id')->where('authId', '=', $userId)->select('newss.*', 'users.name', 'users.email', 'categories.name as cateName')->orderBy('active', 'asc')->orderBy('created_at', 'desc')->paginate(6);
			return view('partner/newsList', ['newssList' => $newssList]);
		}
		else {
			return Redirect::to('/');
		}
	}
	public function saveNewsContent(Request $request) {
		if ($this->checkRole()) {
			$title = $request->input('newsTitle');
			$tmpList = DB::table('newss')->where('title','=', $title)->select('id')->get();
			if (sizeof($tmpList) == 0) {
				$news = new News();
				$news->cateId = $request->input('cateId');
				$news->authId = Auth::user()->id;
				$news->title = $request->input('newsTitle');
				$news->shortDescription = $request->input('shortDescription');
				$news->content = $request->input('content');
				$added = $news->save();
				$maxId = DB::table('newss')->max('id');
				$newId = $maxId;
				$tmpContent = $news->content;
				$firstImageTag = strpos($tmpContent, "<img");
				//
				$firstImgString = substr($tmpContent, $firstImageTag);
				$firstImageEndTag = strpos($firstImgString, "/>");
				$firstImgString = substr($firstImgString,0, $firstImageEndTag + 2);
				//
				$firstSrcTag = strpos($tmpContent, "src=");
				//
				$firstImgString = substr($tmpContent, $firstSrcTag + 5);
				$firstSrcPp = strpos($firstImgString, "\"");
				$firstImgString = substr($firstImgString, 0, $firstSrcPp);
				//
				$img = strrev($firstImgString);
				$firstSignal = strpos($img, '/');
				$img = strrev(substr($img, 0, $firstSignal));
				//
				DB::table('images')->insert([
						'name' => $img
					]);
				$imageId = DB::table('images')->max('id');
				DB::table('newsimages')->insert([
						'newsId' => $newId,
						'imageId' => $imageId
					]);
				echo $added;
			} else {
				echo "Tiêu đề trùng ! Vui lòng chọn tiêu đề khác.";
			}
			
		} else {
			return redirect('/');
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
