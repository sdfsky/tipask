@extends('theme::layout.public')

@section('seo_title')通知提醒 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <!--左侧菜单-->
        @include('theme::layout.profile_menu')

        <div id="main" class="settings col-md-10 form-horizontal main">
            <h2 class="h3 post-title">金币管理</h2>
            <div class="row mt-30 widget-box">
                <p class="mb-20">
                    您当前的金币数为：<strong class="text-gold">{{ Auth()->user()->userData->coins }}</strong> ( <span class="text-danger ml-5"> 1元 = {{ config('pay.charge_rate',0) }} 个金币</span> ) <span class="ml-10">[ <a href="#" data-toggle="modal" data-target="#charge_modal">立即充值</a> ]</span>
                </p>
                <h4>充值流水</h4>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>金额（元）</th>
                        <th>支付方式</th>
                        <th>充值日期</th>
                    </tr>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->money }}</td>
                        <td>{{ $payment->channel }}</td>
                        <td>{{ timestamp_format($payment->created_at) }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="text-center">
                    {!! str_replace('/?', '?', $payments->render()) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <div id="charge_modal" class="modal in" tabindex="-1" role="dialog"  aria-hidden="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">金币充值</h4>
                </div>
                <form name="charge_form" action="{{ route('auth.profile.charge') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    <div class="reward-tpl text-center">
                        <p class="reward-price">
                            <strong class="reward-text">选择充值数目</strong>
                        </p>
                        <div class="reward-price-sample row">
                            <div class="col-sm-4"><button class="form-control btn btn-default" data-price="10">10 金币</button></div>
                            <div class="col-sm-4"><button class="form-control btn btn-default" data-price="30">30 金币</button></div>
                            <div class="col-sm-4"><button class="form-control btn btn-default active" data-price="50">50 金币</button></div>
                            <div class="col-sm-4"><button class="form-control btn btn-default" data-price="100">100 金币</button></div>
                            <div class="col-sm-4"><button class="form-control btn btn-default" data-price="300">300 金币</button></div>
                            <div class="col-sm-4"><input class="form-control reward-price-number text-center" placeholder="自定义"></div>
                        </div>
                    </div>
                    <p class="reward-validate text-center invisible"></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="price" value="0"  />
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="charge_submit">确认</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('/static/js/pingpp/pingpp.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#charge_submit").click(function(){
               var price = 0;
               var input_price  =  $(".reward-price-sample .reward-price-number").val();
               var button_price =  get_button_price();
               if(parseInt(input_price) > 0 ){
                   price = input_price;
               }else if(parseInt(button_price) > 0){
                   price = button_price;
               }

               if(price == 0){
                   $(".reward-price-sample .reward-validate").removeClass("invisible");
                   $(".reward-price-sample .reward-validate").html("请选择充值金币数");
                   return false;
               }

               $("form[name='charge_form'] input[name='price']").val(price);

               if(!$(".reward-price-sample .reward-validate").hasClass('invisible')){
                   $(".reward-price-sample .reward-validate").addClass("invisible");
               }

               $("form[name='charge_form']").submit();

            });

        });
    </script>
@endsection
