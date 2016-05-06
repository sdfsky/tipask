@extends('theme::layout.public')

@section('seo')
    <title>{{ $goods->name }} - 商品详情 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <div class="row mt-20">
        <div class="col-xs-12 col-md-9 main">
            <div class="widget-box mb-10">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="{{ route('website.image.show',['image_name'=>$goods->logo]) }}" alt="{{ $goods->name }}">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $goods->name }}</h4>
                        <div class="mt-20">价格：<span class="text-gold"><i class="fa fa-database"></i> {{ $goods->coins }} 金币</span></div>
                        <div class="mt-20">产品数量：<span class="text-muted">剩余 {{ $goods->remnants }} 个</span></div>
                        <p class="mt-20"><button class="btn btn-primary" role="button">立即兑换</button></p>
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-box-title">商品详情</div>
                <div class="text-fmt">{{ $goods->description }}</div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3 side">
            adfadsf
        </div>

    </div>
@endsection