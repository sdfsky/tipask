@extends('theme::layout.public')

@section('seo_title')我的兑换 - {{ Setting()->get('website_name') }}@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <h2 class="h4  mt-30">
                我的兑换
            </h2>
            <div class="widget-streams border-top">
                @foreach($exchanges as $exchange)
                    <section class="streams-item ">
                        <span class="text-gold"><i class="fa fa-database"></i> {{ $exchange->coins }}</span>
                        <a href="{{ route('shop.goods.detail',['id'=>$exchange->goods_id]) }}" target="_blank">{{ $exchange->goods->name }}</a>
                        @if($exchange->status === 0)
                            <span class="label label-warning ml-10">{{ trans_exchange_status($exchange->status) }}</span>
                        @elseif( $exchange->status ===1 )
                            <span class="label label-success ml-10">{{ trans_exchange_status($exchange->status) }}</span>
                        @else
                            <span class="label label-default ml-10">{{ trans_exchange_status($exchange->status) }}</span>
                        @endif
                        <span class="text-muted ml-10">{{ timestamp_format($exchange->created_at) }}</span>

                    </section>
                @endforeach
            </div>

            <div class="text-center">
                {!! str_replace('/?', '?', $exchanges->render()) !!}
            </div>
        </div>
        @include('theme::layout.right_menu')
    </div>
@endsection