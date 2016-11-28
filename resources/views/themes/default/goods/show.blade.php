@extends('theme::layout.public')

@section('seo_title'){{ $goods->name }} - 商品详情 - {{ Setting()->get('website_name') }}@endsection


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
                        <p class="mt-20"><button class="btn btn-primary btn_exchange" data-goods_id = "{{ $goods->id }}" data-goods_coins="{{ $goods->coins }}" data-goods_name="{{ $goods->name }}"  role="button">立即兑换</button></p>
                        @if(Setting()->get('website_share_code')!='')
                            <div class="mb-10">
                                {!! Setting()->get('website_share_code')  !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-box-title">商品详情</div>
                <div class="text-fmt">{{ $goods->description }}</div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3 side">

            @if(Auth()->check())
                <div class="widget-user">
                    <div class="media">
                        <a class="pull-left" href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}"><img class="media-object avatar-64" src="{{ get_user_avatar(Auth()->user()->id) }}" alt="{{ Auth()->user()->name }}" /></a>
                        <div class="media-body ">
                            <a href="{{ route('auth.space.index',['user_id'=>Auth()->user()->id]) }}" class="media-heading">{{ Auth()->user()->name }}</a>
                            <p class="text-muted"><span class="text-gold"><i class="fa fa-database"></i> {{ Auth()->user()->userData->coins }}</span> </p>
                            <p class="text-muted"><a href="{{ route('shop.exchange.index') }}">我的兑换记录</a></p>
                        </div>
                    </div>
                </div>
            @endif

                <div class="widget-box mt-20">
                    <h4 class="widget-box-title">常见问题</h4>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    1. <a data-toggle="collapse" data-parent="#accordion" href="#what-is-coins" data-target="#what-is-coins" class="collapsed">
                                        什么是金币
                                    </a>
                                </h4>
                            </div>
                            <div id="what-is-coins" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>金币是{{ Setting()->get('website_name') }}的基础货币值，是用户在问答社区帮助他人得到的奖励，可以通过提问、回答问题等多种途径获得，可在积分商城消费。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    2. <a data-toggle="collapse" data-parent="#accordion" href="#get-coins" data-target="#get-coins" class="collapsed">
                                        怎么赚取金币？
                                    </a>
                                </h4>
                            </div>
                            <div id="get-coins" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>可通过回答问题等多种途径获得，详情见</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    3. <a data-toggle="collapse" data-parent="#accordion" href="#post-attentions" data-target="#post-attentions" class="collapsed">
                                        提交信息需要注意什么？
                                    </a>
                                </h4>
                            </div>
                            <div id="post-attentions" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>填写真实有效的邮寄地址、邮编、收件人、联系电话和email地址，并保持电话畅通，这样能准确地签收商品。请妥善保护自己的账号和密码，以免泄露个人信息。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    4. <a data-toggle="collapse" data-parent="#accordion" href="#receive-time" data-target="#receive-time" class="collapsed">
                                        兑换成功后多久能收到？
                                    </a>
                                </h4>
                            </div>
                            <div id="receive-time" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>兑换成功后，知识商城的工作人员将在15日内将您的商品寄出，快递到达时间视情况而定，一般在1-2周之内。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    5. <a data-toggle="collapse" data-parent="#accordion" href="#transport-fee" data-target="#transport-fee" class="collapsed">
                                        邮寄费用由谁承担？
                                    </a>
                                </h4>
                            </div>
                            <div id="transport-fee" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>所有实物的邮寄资费由{{ Setting()->get('website_name') }}承担，邮寄范围仅限中国大陆地区。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>

    </div>
    <div class="modal fade" id="modal_exchange">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">兑换商品</h4>
                </div>
                <div class="modal-body">
                    <form id="exchange_form" method="POST" action="{{ route('shop.goods.exchange') }}">
                        <input type="hidden" id="goods_id" name="goods_id" value="0"  />
                        <div class="alert alert-warning" id="alert_exchange" role="alert"></div>
                        <div class="form-group text-center" id="common_message"></div>
                        <div class="form-group">
                            <label for="real_name" class="required">您的姓名</label>
                            <input type="text" class="form-control" name="real_name" id="real_name" placeholder="您的真实姓名" />
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required">您的电话</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="您的联系电话，非常重要">
                        </div>
                        <div class="form-group" >
                            <label for="email" class="required">您的邮箱</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="您的电子邮箱，非常重要">
                        </div>
                        <div class="form-group">
                            <label for="comment">备注信息</label>
                            <textarea class="form-control" name="comment" placeholder="实物的话需要在备注信息中填写您的收件地址，邮编等信息"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="submit_exchange">立即兑换</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')
    <script  src="{{ asset('/js/shop.js') }}"></script>
@endsection