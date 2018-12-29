@extends('admin/public/layout',['sidebar_collapse'=>Cookie::get('sidebar_collapse'),'notVerifiedData'=>['questions'=>0]])
@section('title')神箭手数据发布@endsection
@section('content')
    <section class="content-header">
        <h1>神箭手数据发布<small style="font-size: 12px">神箭手Tipask数据发布插件，可以将神箭手上爬虫采集的数据、购买的数据、导入的数据、清洗后的数据、机器学习的数据等一键发步到该网站。只需要简单的配置即可实现自动化批量发步，功能丰富强大！</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(isset($_POST['password']))
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        修改成功
                    </div>
                @endif
                <div class="box box-default">
                    <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.shenjian') }}">
                        <input type="hidden" name="_token" id="editor_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>您网站发布地址:</label>
                                <input type="text" class="form-control" disabled="disabled"
                                       value="{{ isIntranet($_SERVER['HTTP_HOST'])?"(当前页面是通过内网访问，无法获取当前公网IP或域名，神箭手不支持发布到内网，请切换至外部网络获取网站发布地址)":url('/') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">发布密码:</label>
                                <input type="text" class="form-control" name="password" value="{{ Setting()->get('shenjian_password')?:"shenjian.io" }}"  />
                            </div>
                            <div class="form-group">
                                <label for="password">是否标题去重:</label>
                                <input type="checkbox" name="unique" value="1" {{ Setting()->get('shenjian_unique')?"checked":"" }} /> (不重复插入相同标题)
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
                <div class="box box-default box-panel">
                    <div class="box-header">插件信息</div>
                    <div class="box-body">
                        <p><label>神箭手云官网:</label><a class="ellipsis" href="http://www.shenjian.io" target="_blank">www.shenjian.io</a></p>
                        <p><label>插件版本:</label>神箭手 Tipask 发布插件 v{{ ta_version()['plug_version'] }}</p>
                        <p><label>相关教程:</label><a class="ellipsis" href="http://docs.shenjian.io/overview/guide/pub.html" target="_blank">如何发布数据</a></p>
                        <p>说明：<br/>1、数据采集爬取请在神箭手官网操作（<a class="ellipsis" href="http://docs.shenjian.io/overview/guide/collect.html" target="_blank">如何爬取数据</a>），采集的数据可以通过该插件发布到Tipask网站<br>
                            2、神箭手<a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/productList" target="_blank">大数据市场</a>内有很多热门网站的爬虫（包括
                            <a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/search&keyword=%E5%BE%AE%E4%BF%A1%E5%85%AC%E4%BC%97%E5%8F%B7" target="_blank">微信公众号文章采集</a>、
                            <a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/search&keyword=%E5%BE%AE%E5%8D%9A" target="_blank">微博采集</a>、
                            <a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/search&keyword=%E4%BB%8A%E6%97%A5%E5%A4%B4%E6%9D%A1" target="_blank">今日头条采集</a>、
                            <a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/search&keyword=%E7%BE%8E%E5%9B%A2" target="_blank">美团采集</a>、
                            <a class="ellipsis" href="http://www.shenjian.io/index.php?r=market/search&keyword=%E6%B7%98%E5%AE%9D" target="_blank">淘宝</a>等电商采集等），您可以免开发直接使用</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .box-panel .box-header{
            font-size: 18px;padding-bottom: 0;
        }
        .box-panel .box-body label{
            width: 120px;
        }
        .box-panel a{
            color: #0073aa;
        }
        .box-panel a:active, .box-panel a:hover{
            color: #00a0d2;
        }
    </style>
@endsection