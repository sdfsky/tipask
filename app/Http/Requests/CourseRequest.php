<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function getStoreRules()
    {
        return [
            //
            'title' => 'required',
            'logo' => 'required',
            'description' => 'required',
            'price'=> 'sometimes|digits_between:0,100',
            'tags' => 'sometimes|max:128',
            'category_id' => 'sometimes|numeric'
        ];
    }

    public function getUpdateCourseRules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'sometimes|max:65535',
            'price'=> 'sometimes|digits_between:0,100',
            'tags' => 'sometimes|max:128',
            'category_id' => 'sometimes|numeric'
        ];
    }

    public function getAddVideoRules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'sometimes|max:65535',
            'chapter_id' => 'sometimes|numeric',
            'course_id' => 'sometimes|numeric'
        ];
    }

    // 添加章节
    public function getStoreChapterRules()
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    // 修改章节
    public function getUpdateChapterRules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'chapter_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '课程标题不能为空',
            'logo.required' => '课程logo不能为空',
            'description.required'  => '课程详情不能为空',
            'chapter_id.required' => '课程ID不能为空'
        ];
    }
}
