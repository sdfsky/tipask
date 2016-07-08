
@extends('emails.layout')

@section('title')发送邮箱激活邮件@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {{ $name }} 您好，请激活您在{{ Setting()->get('website_name') }}注册的邮箱！
                <br />
                如非本人操作，请忽略此邮件！
            </td>
        </tr>
        <tr>
            <td class="content-block">
                请在 1 小时内点击下面的链接激活此账号：
            </td>
        </tr>
        <tr>
            <td class="content-block">
                {{ route('auth.email.verifyToken',['action'=>$type,'token'=>$data->token]) }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection

