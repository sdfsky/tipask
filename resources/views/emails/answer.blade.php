@extends('emails.layout')

@section('title')问题有了新回答@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                回答内如如下：<br />
                {{ str_limit(strip_tags($data->content),200) }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                点击下方链接查看回答详情：
            </td>
        </tr>
        <tr>
            <td class="content-block">
                {{ route('ask.answer.detail',['question_id'=> $data->question_id ,'id'=>$data->id]) }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection
