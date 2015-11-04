@extends('theme::account.layout')

@section('seo')
    <title>用户注册</title>
@stop

@section('content')
    <div class="header text-center">
        <h1>
            <a href="/" class="logo">
                <img src="//sf-static.b0.upaiyun.com/global/img/logo-b.f7391d73.svg" alt="SegmentFault">
            </a>
        </h1>
        <p class="description text-muted">欢迎加入最专业的中文开发者社区</p>
    </div>
    <div class="col-md-6 col-md-offset-3 bg-white login-wrap">
        <h1 class="h4 text-center text-muted login-title">创建新账号</h1>
        <form role="form" id="registerForm" action="{{ route('auth.user.register') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group @if ($errors->first('name')) has-error @endif">
                <label class="required">姓名</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required  placeholder="姓名">
                @if ($errors->first('name'))
                 <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group @if ($errors->first('email')) has-error @endif">
                <label class="required">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="hello@tipask.com">
                @if ($errors->first('email'))
                 <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="" class="required">密码</label>
                <input type="password" class="form-control" name="password" required placeholder="不少于 6 位">
            </div>
            <div class="form-group @if ($errors->first('password')) has-error @endif">
                <label for="" class="required">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation" required placeholder="不少于 6 位">
                @if ($errors->first('password'))
                 <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                同意并接受<a href="javascript:;" target="_blank" data-toggle="modal" data-target=".bs-example-modal-lg">《服务条款》</a>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">注册</button>
            </div>
        </form>
    </div>


    <div class="text-center col-md-12 login-link">
        <a href="{{ route('auth.user.login') }}">用户登录</a>
        |
        <a href="{{ route('website.index') }}">首页</a>
        |
        <a href="{{ route('auth.user.forgetPassword') }}">找回密码</a>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <p>SegmentFault 拥有 segmentfault.com（http://segmentfault.com）及其涉及到的产品、相关软件的所有权和运作权， SegmentFault 享有对 segmentfault.com 上一切活动的监督、提示、检查、纠正及处罚等权利。用户通过注册程序阅读本服务条款并点击"同意"按钮完成注册，即表示用户与 SegmentFault 已达成协议，自愿接受本服务条款的所有内容。如果用户不同意服务条款的条件，则不能获得使用 SegmentFault 服务以及注册成为 SegmentFault 用户的权利。</p>
                <h2>使用规则</h2>
                <ol>
                    <li>用户注册成功后，SegmentFault 将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。</li>
                    <li>用户须对在 SegmentFault 的注册信息的真实性、合法性、有效性承担全部责任，用户不得冒充他人；不得利用他人的名义发布任何信息；不得恶意使用注册帐户导致其他用户误认；否则 SegmentFault 有权立即停止提供服务，收回其帐号并由用户独自承担由此而产生的一切法律责任。</li>
                    <li>用户不得使用 SegmentFault 服务发送或传播敏感信息和违反国家法律制度的信息，包括但不限于下列信息:
                        <ul>
                            <li>反对宪法所确定的基本原则的；</li>
                            <li>危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；</li>
                            <li>损害国家荣誉和利益的；</li>
                            <li>煽动民族仇恨、民族歧视，破坏民族团结的；</li>
                            <li>破坏国家宗教政策，宣扬邪教和封建迷信的；</li>
                            <li>散布谣言，扰乱社会秩序，破坏社会稳定的；</li>
                            <li>散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；</li>
                            <li>侮辱或者诽谤他人，侵害他人合法权益的；</li>
                            <li>含有法律、行政法规禁止的其他内容的。</li>
                        </ul>
                    </li>
                    <li>SegmentFault 有权对用户使用 SegmentFault 的情况进行审查和监督，如用户在使用 SegmentFault 时违反任何上述规定，SegmentFault 或其授权的人有权要求用户改正或直接采取一切必要的措施（包括但不限于删除用户张贴的内容、暂停或终止用户使用 SegmentFault 的权利）以减轻用户不当行为造成的影响。</li>
                    <li>盗取他人用户帐号或利用网络通讯骚扰他人，均属于非法行为。用户不得采用测试、欺骗等任何非法手段，盗取其他用户的帐号和对他人进行骚扰。 </li>
                </ol>
            </div>
        </div>
    </div>
@endsection



