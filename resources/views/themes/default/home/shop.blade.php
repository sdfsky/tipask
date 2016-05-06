@extends('theme::layout.public')

@section('seo')
    <title>商城 - {{ Setting()->get('website_name') }}</title>
    <meta name="description" content="tipask问答系统交流平台" />
    <meta name="keywords" content="问答系统,PHP问答系统,Tipask问答系统 " />
@endsection

@section('content')
    <h1 class="h3">积分商城<br><small></small></h1>
    <div class="row tag-list mt-20">
        @foreach( $goods as $good )
        <section class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img alt="{{ $good->name }}" src="{{ route('website.image.show',['image_name'=>$good->logo]) }}" style="height: 200px; width: 100%; display: block;">
                <div class="caption">
                    <h4 class="text-center"><a href="{{ route('shop.goods.detail',['id'=>$good->id]) }}">{{ $good->name }}</a></h4>
                    <p class="text-center"><span class="text-gold"><i class="fa fa-database"></i> {{ $good->coins }} 金币</span><span class="text-muted ml-10">剩余 {{ $good->remnants }} 个</span></p>
                    <p><button class="btn btn-primary btn-block btn_exchange" data-goods_id = "{{ $good->id }}" data-goods_coins="{{ $good->coins }}" data-goods_name="{{ $good->name }}"  role="button" @if( Auth()->user()->userData->coins < $good->coins ) disabled @endif  >立即兑换</button></p>
                </div>
            </div>
        </section>
        @endforeach

    </div>
    <div class="text-center">
        {!! str_replace('/?', '?', $goods->render()) !!}
    </div>

    <div class="modal fade" id="modal_exchange">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">兑换商品</h4>
                </div>
                <form>
                <div class="modal-body">

                    <div class="alert alert-info" id="alert_exchange" role="alert"></div>
                        <div class="form-group">
                            <label for="real_name">您的姓名</label>
                            <input type="text" class="form-control" id="real_name" placeholder="您的真实姓名" />
                        </div>
                        <div class="form-group">
                            <label for="phone">您的电话</label>
                            <input type="text" class="form-control" id="phone" placeholder="您的联系电话，非常重要">
                        </div>
                        <div class="form-group">
                            <label for="email">您的邮箱</label>
                            <input type="email" class="form-control" id="email" placeholder="您的电子邮箱，非常重要">
                        </div>
                        <div class="form-group">
                            <label for="comment">备注信息</label>
                            <textarea class="form-control" placeholder="实物的话需要在备注信息中填写您的收件地址，邮编等信息"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary">立即兑换</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $(".btn_exchange").click(function(){
                var goods_name = $(this).data('goods_name');
                var goods_coins = $(this).data('goods_coins');
                $("#alert_exchange").html('你要兑换的商品是【'+goods_name+'】，兑换成功后会扣除 '+goods_coins+' 金币！');
                $("#modal_exchange").modal();
            });
        });
    </script>
@endsection