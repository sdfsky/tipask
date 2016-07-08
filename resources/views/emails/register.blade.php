
@extends('emails.layout')

@section('title')用户注册激活@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {{ $name }} 您好，感谢您注册 {{ Setting()->get('website_name') }} !
            </td>
        </tr>
        <tr>
            <td class="content-block">
                请在 1 小时内点击下面的链接激活此账号：
            </td>
        </tr>
        <tr>
            <td class="content-block">
                {{ route('auth.email.verifyToken',['action'=>$data->action,'token'=>$data->token]) }}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection
