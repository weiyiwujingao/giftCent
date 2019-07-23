@extends('home.layouts.layout')
@section('css')
<link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,order_detail.css" />
@endsection
@section('content')
    @include('home.common.header',['title'=>'订单详情','backUrl'=>''])
    <div class="order_detail">
        <article class="weui-article">
            <div class="weui-flex item">
                <div class="left"><img src="/images/default-bg.jpg"/></div>
                <div class="weui-flex__item title">超级好吃的榴莲千层</div>
                <div class="right">
                    <strong>￥168.00</strong>
                    <i>数量： x2</i>
                </div>
            </div>
            <div class="weui-flex item">
                <div class="left"><img src="/images/default-bg.jpg"/></div>
                <div class="weui-flex__item title">超级好吃的榴莲千层超级好吃的榴莲千层超级好吃的榴莲千层超级好吃的榴莲千层</div>
                <div class="right">
                    <strong>￥168.00</strong>
                    <i>数量： x2</i>
                </div>
            </div>
        </article>
        <div class="foot">总计：￥520.00</div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单编码：</label></div>
                <div class="weui-cell__bd">201805203838</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">支付方式：</label></div>
                <div class="weui-cell__bd">微信支付</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单时间：</label></div>
                <div class="weui-cell__bd">2018-10-31 20:22:22</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">配送方式：</label></div>
                <div class="weui-cell__bd">门店自取</div>
            </div>
        </div>
    </div>
    <div class="get_mess">
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">取货信息：</label></div>
            </div>
        </div>
        <div class="qhbx">
            <p>下单门店：马家龙工业区幸福加焙店</p>

            <p>取货时间：2018-05-25（周五）14:30</p>

            <p>取货人：李三</p>

            <p>手机号：1383838438</p>
        </div>
        <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">收货信息：</label></div>
            </div>
        </div>
        <div class="qhbx">
            <p>收货地址：马家龙工业区幸福加焙店</p>

            <p>收货时间：2018-05-25（周五）14:30</p>

            <p>收货人：李三</p>

            <p>手机号：1383838438</p>
        </div>

    </div>
@endsection