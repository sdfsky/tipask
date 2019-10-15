<?php

namespace App\Http\Controllers\Account;

use App\Models\Draft;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DraftController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $drafts = Draft::where('user_id',$user_id)->get()->toArray();
        return view('theme::draft.index')->with(compact('drafts'));
    }

    /**
     * 创建草稿
     * @param Request $request
     * @param $type
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, $type)
    {
        $loginUser = $request->user();
        if ($type == 'question') {
            $data = [
                'id'             => $request->input('_token'),
                'user_id'        => $loginUser->id,
                'editor_content' => clean($request->input('description','')),
                'subject'        => trim($request->input('title','')),
                'source_type'    => 'question',
                'source_id'      => $request->input('id', 0),
                'form_data'      => json_encode([
                    'category_id' => $request->input('category_id', 0),
                    'price'       => $price = abs($request->input('price',0)),
                    'hide'        => intval($request->input('hide',0)),
                    'tags'        => trim($request->input('tags','')),
                    'to_user_id' => $request->input('to_user_id',0)
                ]),
            ];
        } elseif ($type == 'answer') {
            $question = Question::find($request->input('question_id'));
            $data = [
                'id'             => $request->input('_token'),
                'user_id'        => $loginUser->id,
                'editor_content' => clean($request->input('content')),
                'subject'        => $question->title,
                'source_type'    => 'answer',
                'source_id'      => $request->input('question_id', 0),
                'form_data'      => json_encode([]),
            ];
        } elseif ($type == 'article') {
            $data = [
                'id'             => $request->input('_token'),
                'user_id'        => $loginUser->id,
                'editor_content' => clean($request->input('content')),
                'subject'        => trim($request->input('title')),
                'source_type'    => 'article',
                'source_id'      => $request->input('id', 0),
                'form_data'      => json_encode([
                    'category_id' => $request->input('category_id', 0),
                ]),
            ];
        }
        $draft = Draft::find($data['id']);
        if ( !empty($draft)) {
            Draft::where('id', $data['id'])->update($data);
        } else {
            Draft::create($data);
        }
        return response()->json($data);
    }

    /**
     * 清空草稿箱
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function cleanAll(Request $request)
    {
        $user_id = $request->user()->id;
        $result = Draft::where('user_id', $user_id)->delete();
        return $this->success(route('auth.draft.index'),'操作成功！');
    }

    /**
     * 删除草稿
     * @param Request $request
     * @param $id
     * @return
     */
    public function destroy(Request $request, $id)
    {
        $user_id = $request->user()->id;
        $result = Draft::where('id', $id)->where('user_id', $user_id)->delete();
        return $this->success(route('auth.draft.index'),'操作成功！');
    }
}
