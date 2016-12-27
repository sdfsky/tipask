<?php

namespace App\Http\Controllers\Account;

use App\Models\Attention;
use App\Models\Authentication;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{

    protected  $validateRules = [
        'real_name' => 'required|max:64',
        'id_card' => 'required|max:64|unique:authentications',
        'id_card_image' => 'required|image|max:2048',
        'skill' => 'required|max:128',
        'skill_image' => 'required|image|max:2048',
        'captcha' => 'required|captcha',
    ];
    /**
     * 显示认证信息
     */
    public function getIndex()
    {
        return view('theme::authentication.index');
    }

    /**
     * 认证信息提交
     */
    public function postStore(Request $request)
    {

        $this->validate($request,$this->validateRules);

        $data = $request->all();

        $data['user_id'] = $request->user()->id;

        if($request->hasFile('id_card_image')){
            $savePath = storage_path('app/authentications');
            $file = $request->file('id_card_image');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $data['id_card_image'] = 'authentications-'.$fileName;
            }
        }

        if($request->hasFile('skill_image')){
            $savePath = storage_path('app/authentications');
            $file = $request->file('skill_image');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $data['skill_image'] = 'authentications-'.$fileName;
            }
        }

        Authentication::create($data);

        $this->attendToTags(explode(",",$data['skill']),$request->user()->id);

        return $this->success(route('auth.authentication.index'),'您的申请已经提交成功！我们会在3个工作日内完成审核，请耐心等待！');

    }


    /*修改认证信息*/
    public function anyEdit(Request $request)
    {

        if($request->isMethod('post')) {
            $this->validateRules['id_card'] = 'required|max:64|unique:authentications,id_card,'.$request->user()->id.',user_id';
            $this->validate($request, $this->validateRules);
            $data = $request->all();
            $data['status'] = 0;
            if ($request->hasFile('id_card_image')) {
                $savePath = storage_path('app/authentications');
                $file = $request->file('id_card_image');
                $fileName = uniqid(str_random(8)) . '.' . $file->getClientOriginalExtension();
                $target = $file->move($savePath, $fileName);
                if ($target) {
                    $data['id_card_image'] = 'authentications-' . $fileName;
                }
            }

            if ($request->hasFile('skill_image')) {
                $savePath = storage_path('app/authentications');
                $file = $request->file('skill_image');
                $fileName = uniqid(str_random(8)) . '.' . $file->getClientOriginalExtension();
                $target = $file->move($savePath, $fileName);
                if ($target) {
                    $data['skill_image'] = 'authentications-' . $fileName;
                }
            }

            $request->user()->authentication->update($data);

            $this->attendToTags(explode(",",$data['skill']),$request->user()->id);

            return $this->success(route('auth.authentication.index'),'您的申请已经提交成功！我们会在3个工作日内完成审核，请耐心等待！');
        }

        $authentication = $request->user()->authentication;
        return view('theme::authentication.edit')->with(compact('authentication'));

    }


    /*关注标签*/
    private function attendToTags($tags,$userId){
        foreach( $tags as $tag ){
            $newTag = Tag::firstOrCreate(['name'=>$tag]);
            $attention = Attention::where("user_id",'=',$userId)->where('source_type','=',get_class($newTag))->where('source_id','=',$newTag->id)->first();
            if(!$attention){
                Attention::create([
                    'user_id'     => $userId,
                    'source_id'   => $newTag->id,
                    'source_type' => get_class($newTag),
                ]);
                Tag::find($newTag->id)->increment('followers');
            }

        }
    }



}
