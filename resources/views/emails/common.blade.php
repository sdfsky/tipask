@extends('emails.layout')

@section('title')邮件通知@endsection

@section('content')
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                {!! $body !!}
            </td>
        </tr>
        <tr>
            <td class="content-block">
                &mdash; {{ Setting()->get('website_name') }}
            </td>
        </tr>
    </table>
@endsection
