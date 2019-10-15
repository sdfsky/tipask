@extends('emails.layout')

@section('title')发送测试邮件@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {{ $content }}
                <br />
                如非本人操作，请忽略此邮件！
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection