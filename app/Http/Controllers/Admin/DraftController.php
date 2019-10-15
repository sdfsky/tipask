<?php

namespace App\Http\Controllers\Admin;

use App\Models\Draft;
use Illuminate\Http\Request;

class DraftController extends AdminController
{
    // 草稿列表
    public function index(Request $request)
    {
        $filter = $request->all();

        $query = Draft::query();

        /*人过滤*/
        if (isset($filter['user_id']) && $filter['user_id'] > 0) {
            $query->where('user_id', '=', $filter['user_id']);
        }

        /*关键词过滤*/
        if (isset($filter['word']) && $filter['word']) {
            $query->where('subject', 'like', '%' . $filter['word'] . '%');
        }

        /*时间过滤*/
        if (isset($filter['date_range']) && $filter['date_range']) {
            $query->whereBetween('created_at', explode(" - ", $filter['date_range']));
        }

        /*草稿类型过滤*/
        if (isset($filter['source_type'])) {
            $query->where('source_type', '=', $filter['source_type']);
        }

        $drafts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view("admin.draft.index")->with('drafts', $drafts)->with('filter', $filter);

    }

    // 删除草稿
    public function destroy(Request $request)
    {
        Draft::destroy($request->input('id'));
        return $this->success(route('admin.draft.index'),'删除草稿成功');
    }
}
