<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{

    /**
     * 显示用户头像
     * @param $avatar_name
     * @return mixed
     */
    public function avatar($avatar_name)
    {
        $fileName = str_replace("..","",$avatar_name);

        list($user_id,$size) = explode('_',str_replace(".jpg",'',$fileName));
        $avatarFile = storage_path('app/'.User::getAvatarPath($user_id,$size));
        if(!is_file($avatarFile)){
            $avatarFile = public_path('static/images/default_avatar.jpg');
        }
        $image =   Image::make($avatarFile);
        $response = response()->make($image->encode('jpg'));
        $image->destroy();
        $response->header('Content-Type', 'image/jpeg');
        $response->header('Expires',  date(DATE_RFC822,strtotime(" 2 day")));
        $response->header('Cache-Control', 'private, max-age=86400, pre-check=86400');
        return $response;
    }



    public function show($image_name)
    {
        $fileName = str_replace("..","",$image_name);

        $imageFile = storage_path('app/'.str_replace("-","/",$fileName));
        if(!is_file($imageFile)){
            abort(404);
        }


        $image =   Image::make($imageFile);

        if(config('tipask.upload.open_watermark') && $fileName != config('tipask.upload.watermark_image') && str_contains($fileName,'attachments')){
            $watermarkImage = storage_path('app/'.str_replace("-","/",config('tipask.upload.watermark_image')));
            $image->insert($watermarkImage, 'bottom-right', 15, 10);
        }
        $response = response()->make($image->encode('jpg'));
        $response->header('Content-Type', 'image/jpeg');
        $response->header('Expires',  date(DATE_RFC822,strtotime(" 7 day")));
        $response->header('Cache-Control', 'private, max-age=259200, pre-check=259200');
        return $response;
    }



    /*编辑器图片上传*/
    public function upload(Request $request)
    {
        $validateRules = [
            'file' => 'required|image|max:'.config('tipask.upload.attach_size'),
        ];

        if($request->hasFile('file')){
            $validator = Validator::make($request->all(),$validateRules);
            if ($validator->fails()) {
                return response('error');
            }
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension()?$file->getClientOriginalExtension():'jpg';
            $filePath = 'attachments/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            return response(route("website.image.show",['image_name'=>str_replace("/","-",$filePath)]));
        }
        return response('error');
    }

}
