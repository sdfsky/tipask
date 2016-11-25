@extends('emails.layout')

@section('title')回答问题@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {{ $subject }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                点击下方链接查看问题详情：
            </td>
        </tr>
        <tr>
            <td class="content-block">
                {{ route('ask.question.detail',['id'=>$data->id]) }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection
