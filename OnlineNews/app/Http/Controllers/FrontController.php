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

use App\News;

class FrontController extends Controller
{
	//
	public function addToBookmark(Request $request) {
		if(Auth::check()) {
			$newsId = $request->input('newsId');
			$bookmark = DB::table('bookmarks')->where('userId', '=', Auth::user()->id)->where('newsId', '=', $newsId)->get();
			if (sizeof($bookmark) != 0) {
				echo "Tin đã có sắn trong bookmark !";
			}
			else {
				$inserted = DB::table('bookmarks')->insert(['userId' => Auth::user()->id, 'newsId' => $newsId ]);
				if ($inserted != 0) {
					echo "Tin đã được thêm vào bookmark !";
				}
				else {
					echo "Xảy ra lỗi ! Vui lòng thao tác lại.";
				}
			}
		}
		else {
			echo "Vui lòng đăng nhập !";
		}
	}
    //
    public function getCategories(Request $request) {
    	$catesList = DB::table('categories')->get();
    	$jsonData = json_encode($catesList);
    	echo $jsonData;
    }
    //
    public function getNewsOfCate(Request $request) {
    	$cateId = $request->input('jsonData');
    	$newss = DB::table('newss')->where('cateId', '=', $cateId)->where('active', '=', 1)->orderBy('updated_at', 'desc')->get();
    	//$newssList = (array) new News();
    	for ($i = 0; $i < sizeof($newss); $i ++) {
    		# code...
    		//array_push($newssList, $newss[$i]);
    		$imgsId = DB::table('newsImages')->where('newsId' , '=', $newss[$i]->id)->get();
    		for ($j = 0; $j < sizeof($imgsId); $j ++) {
    			if ($j == 0) {
    				$newss[$i]->imagesList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
    			}
    			else {
    				$tmpList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
    				array_push($newss[$i]->imagesList, $tmpList['0']);
    			}
    		}
    		
    	}
    	$jsonData = json_encode($newss);
    	echo $jsonData;
    }
    //
    public function getHottestList(Request $request) {
    	$newss = DB::table('newss')->orderBy('updated_at', 'desc')->where('active', '=', 1)->take(12)->get();
    	//$newssList = (array) new News();
    	for ($i = 0; $i < sizeof($newss); $i ++) {
    		# code...
    		//array_push($newssList, $newss[$i]);
    		$imgsId = DB::table('newsImages')->where('newsId' , '=', $newss[$i]->id)->get();
    		for ($j = 0; $j < sizeof($imgsId); $j ++) {
    			if ($j == 0) {
    				$newss[$i]->imagesList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
    			}
    			else {
    				$tmpList = DB::table('images')->where('id' , '=', $imgsId[$j]->imageId)->select('name')->get();
    				array_push($newss[$i]->imagesList, $tmpList['0']);
    			}
    		}
    		
    	}

    	$jsonData = json_encode($newss);
    	echo $jsonData;
    }
}
