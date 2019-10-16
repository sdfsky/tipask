@extends('admin.public.layout')

@section('title') 首页 @endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            网站总览
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">注册用户数</span>
                        <span class="info-box-number">{{ $totalUserNum }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-question-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">问题总数</span>
                        <span class="info-box-number">{{ $totalQuestionNum }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-edit"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">文章总数</span>
                        <span class="info-box-number">{{ $totalArticleNum }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">回答总数</span>
                        <span class="info-box-number">{{ $totalAnswerNum }}</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">一周用户数据报告</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>一周用户趋势数据</strong>
                                </p>
                                <div class="chart">
                                    <canvas id="user_chart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">问答数据报告</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>问题、文章、回答统计</strong>
                                </p>
                                <div class="chart">
                                    <canvas id="question_chart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">系统信息</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>软件版本：{{ config('tipask.version') }} Release {{ config('tipask.release') }} [<a href="http://www.tipask.com/download.html">查看最新版本</a>]</td>
                                    </tr>
                                    <tr>
                                        <td>服务器域名： {{ $systemInfo['hostName'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>PHP版本： {{ $systemInfo['phpVersion'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>服务器端信息：{{ $systemInfo['runOS'] }}/{{ $systemInfo['serverInfo'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>最大上传限制：{{ $systemInfo['maxUploadSize'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>最大执行时间：{{ $systemInfo['maxExecutionTime'] }} seconds</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">版权申明</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>版权所有：www.tipask.com</td>
                                    </tr>
                                    <tr>
                                        <td>用户协议：<a href="http://www.tipask.com/license.html" target="_blank">查看用户协议</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

@section('script')
<script type="text/javascript" src="{{ asset('/static/js/chartjs/chartjs.js') }}"></script>
<script type="text/javascript">
    $(function(){
        set_active_menu('root_menu',"{{ route('admin.index.index') }}");
        var userChart = new Chart($("#user_chart"), {
            type: 'line',
            data: {
                labels: [{!! implode(",",$userChart['labels']) !!}],
                datasets: [
                    {
                    label: '注册数',
                        backgroundColor: "rgba(51,102,102,0.8)",
                        borderColor: "rgba(51,102,102,0.8)",
                        fill: false,

                        data: [{{ implode(",",$userChart['registerUsers']) }}]
                    },
                    {
                        fill: false,

                        backgroundColor: "rgba(153,51,51,0.8)",
                        borderColor: "rgba(153,51,51,0.8)",

                        label: '已审核',
                        data: [{{ implode(",",$userChart['verifyUsers']) }}]
                    },
                    {
                        fill: false,

                        backgroundColor: "rgba(153,102,0,0.8)",
                        borderColor: "rgba(153,102,0,0.8)",

                        label: '行家认证',
                        data: [{{ implode(",",$userChart['authUsers']) }}]
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        var questionChart = new Chart($("#question_chart"), {
            type: 'bar',
            data: {
                labels: [{!! implode(",",$questionChart['labels']) !!}],
                datasets: [
                    {
                    label: '提问',
                        backgroundColor: "rgba(204,102,51,0.9)",
                        data: [{{ implode(",",$questionChart['questionRange']) }}]
                    },
                    {
                        label: '回答',
                        backgroundColor: "rgba(51,102,153,0.9)",
                        data: [{{ implode(",",$questionChart['answerRange']) }}]
                    },
                    {
                        label: '文章',
                        backgroundColor: "rgba(0,166,90,0.9)",
                        data: [{{ implode(",",$questionChart['articleRange']) }}]
                    },
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

    });
</script>
@endsection