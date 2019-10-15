<?php

namespace App\Http\Controllers\Admin;

use App\Models\Draft;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends AdminController
{
    // 举报列表
    public function index(Request $request)
    {
        $filter = $request->all();

        $query = Report::query();

        /*举报人过滤*/
        if (isset($filter['user_id']) && $filter['user_id'] > 0) {
            $query->where('user_id', '=', $filter['user_id']);
        }

        /*举报类型过滤*/
        if (isset($filter['status'])) {
            $query->where('status', '=', $filter['status']);
        }

        /*时间过滤*/
        if (isset($filter['date_range']) && $filter['date_range']) {
            $query->whereBetween('created_at', explode(" - ", $filter['date_range']));
        }
        $reports = $query->orderBy('created_at', 'desc')->paginate(config('tipask.admin.page_size'));
        return view("admin.report.index")->with('reports', $reports)->with('filter', $filter);

    }

    // 删除举报
    public function destroy(Request $request)
    {
        Report::destroy($request->input('id'));
        return $this->success(route('admin.report.index'), '删除成功');
    }

    // 忽略举报
    public function ignore(Request $request)
    {
        $ids = $request->input('id');
        if ( !empty($ids)) {
            Report::whereIn('id', $ids)->where('status', 0)->update(['status' => 4]);
        }
        return $this->success(route('admin.report.index'), '处理成功');
    }

    // 处理举报
    public function dispose(Request $request)
    {
        $ids = $request->input('id');
        if ( !empty($ids)) {
            Report::whereIn('id', $ids)->where('status', 0)->update(['status' => 1]);
        }
        return $this->success(route('admin.report.index'), '处理成功');
    }

}
