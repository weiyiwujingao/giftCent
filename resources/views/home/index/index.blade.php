@extends('home.layouts.layout')
@section('css')
 <link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=index.css" />
@endsection
@section('content')
    <div class="weui-flex top_menu">
        <div class="weui-flex__item" data-location="/home/order/index?type=1"><i class="iconfont icon-icon_today"><span class="weui-badge">20</span></i>今日订单</div>
        <div class="weui-flex__item" data-location="/home/order/index?type=2"><i class="iconfont icon-icon_History"></i>待确认订单<span class="weui-badge">10</span></div>
        <div class="weui-flex__item" data-location="/home/order/index?type=3"><i class="iconfont icon-icon_cancel"></i>待退货订单<span class="weui-badge">6</span></div>
    </div>
    <div class="weui-flex cn_state">
        <div class="weui-flex__item first-child">
            <strong>￥500.00</strong>
            今日营业额
        </div>
        <div class="weui-flex__item">
            <strong>￥11,500.00</strong>
            本月营业额
        </div>
    </div>
    <div class="cnt_bx">
        <div class="weui-flex">
            <div class="weui-flex__item" data-location="/home/order/index">
                <i class="iconfont">
                    <img src="/images/icon_order.png"/>
                </i>
                订单管理
            </div>
            <div class="weui-flex__item" data-location="/home/goods/index">
                <i class="iconfont">
                    <img src="/images/icon_goods.png"/>
                </i>
                商品管理
            </div>
            <div class="weui-flex__item" data-location="/home/user/set">
                <i class="iconfont">
                    <img src="/images/icon_set.png"/>
                </i>
                店铺设置
            </div>
        </div>
        {{--<div class="weui-flex">
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                评价管理
            </div>
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                订单管理
            </div>
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                核销管理
            </div>
        </div>--}}
    </div>
    @include('home.common.foot_menu',['idx'=>1])
@endsection