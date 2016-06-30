<?php namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Fileentry;
use Request;
 

use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
 
class FileEntryController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function deleteImage() {
		$imgName = Request::get('imgName');
		$deleted = DB::table('fileentries')->where('filename','=', $imgName)->delete();
		File::delete(Storage::disk('s3')->getDriver()->getAdapter()->getPathPrefix().$imgName);
		return $deleted;
	}

	public function add() {
 
		$file = Request::file('filefield');
		$extension = $file->getClientOriginalExtension();
		Storage::disk('s3')->put($file->getFilename().'.'.$extension,  File::get($file));
		$entry = new Fileentry();
		$entry->mime = $file->getClientMimeType();
		$entry->original_filename = $file->getClientOriginalName();
		$entry->filename = $file->getFilename().'.'.$extension;
 
		$entry->save();
 
		return redirect('/show');
		
	}


	// public function get($filename){
	
	// 	$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
	// 	$file = Storage::disk('local')->get($entry->filename);

	// 	return (new Response($file, 200))
 //              ->header('Content-Type', $entry->mime);
	// }



	public function getAllImage() {
		$imgNameList = array();
		$imgDataList = array();
		$filesList = Fileentry::all();
		foreach ($filesList as $img) {
			array_push($imgNameList, $img->filename);
			if (Storage::disk('s3')->has($img->filename)) {
				$tmpImgData = base64_encode(Storage::disk('s3')->get($img->filename));
				array_push($imgDataList, $tmpImgData);
			}
			else {
				array_push($imgDataList, "");
			}
		}
		$data = array(
            'imgsNameList'=> $imgNameList,
            'imgsDataList' => $imgDataList
            );
        return view('test')->with($data);
		// foreach ($imgNameList as $imName) {
		// 	# code...
		// 	print_r($imName);
		// 	Storage::get($imName);
		// 	echo "<br/>";
		// }
	}
}