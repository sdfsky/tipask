<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/2/4
 * Time: 下午3:12
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AttachController extends Controller
{

    public function upload(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|max:'.config('tipask.upload.attach_size'),
        ]);

        if($validator->fails()){
            return $this->ajaxError(10000,$validator->errors()->first('file'));
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filePath = 'attachments/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
        Storage::disk('local')->put($filePath,File::get($file));

        return $this->ajaxSuccess([
            'url'=>route("website.attach.download",['name'=>str_replace("/","-",$filePath)]),
            'name'=>$file->getClientOriginalName()
        ]);
    }


    public function download($name){
        $attachFile = storage_path('app/'.str_replace("-","/",$name));
        if(!is_file($attachFile)){
            abort(404);
        }
        return response()->download($attachFile);
    }



}