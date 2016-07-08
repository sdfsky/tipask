@extends('emails.layout')

@section('title')邀请回答问题@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {{ $name }}正在向你发问题求助：{{ $data->title }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                点击下方链接查看问题详情并解答：
            </td>
        </tr>
        <tr>
            <td class="content-block">
                <a href="{{ route('ask.question.detail',['id'=>$data->id]) }}">{{ route('ask.question.detail',['id'=>$data->id]) }}</a>
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection
