@extends('home.layouts.layout')
@section('css')
<link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,goods_detail.css" />
@endsection
@section('content')
    @include('home.common.header',['title'=>'商品详情','backUrl'=>''])
    <div class="goods_detail">
        <div class="head_img">
            <img src="/images/default-bg.jpg">
        </div>
        <div class="goods_cnt">
            <div class="goods_name">左伦蛋糕榴芒双拼</div>
            <dl class="guige">
                <dt>口味：</dt>
                <dd>
                    <span class="weui-btn weui-btn_mini weui-btn_primary">芒果千层</span>
                    <span class="weui-btn weui-btn_mini weui-btn_default">芒果千层</span>
                    <span class="weui-btn weui-btn_mini weui-btn_default">芒果千层</span>
                </dd>
                <dt>尺寸：</dt>
                <dd>
                    <span class="weui-btn weui-btn_mini weui-btn_primary">1磅</span>
                    <span class="weui-btn weui-btn_mini weui-btn_default">2磅</span>
                    <span class="weui-btn weui-btn_mini weui-btn_default">3磅</span>
                </dd>
            </dl>
            <div class="weui-flex buybx">
                <div class="weui-flex__item">购买数量：</div>
                <div class="opetate">
                    <div class="icon">
                        <i class="iconfont icon-jian-copy-copy"></i>
                    </div>
                    <div class="input">
                        <input type="tel" class="weui-input" value="1" readonly>
                    </div>
                    <div class="icon">
                        <i class="iconfont icon-icon_plus-copy"></i>
                    </div>
                </div>
            </div>
            <div class="weui-flex gwcb">
                <div class="weui-flex__item">
                    <button class="weui-btn weui-btn_mini weui-btn_default">加入购物车</button>
                </div>
                <div class="weui-flex__item right">
                    <button class="weui-btn weui-btn_mini weui-btn_primary" onclick="location='{{ url('/home/order/settlement') }}';">立即购买</button>
                </div>
            </div>
            <div class="weui-article detail_mess">
                <h1 class="title">温馨提示：</h1>
                <div class="tips">
                    <p>1、请提前24小时预定。</p>
                    <p>2、全东莞市，佛山市专车免运费配送；深圳市，
                        广州市滴滴顺风车免运费配送。支持异地下单！</p>
                    <p>3、配送地址请填写地图和导航可以找到的地址哦，
                        不然送货员很难找得到的呢。配送时间有1小时
                        左右的余量，请谅解！</p>
                </div>
                <div class="extract"></div>
                <div class="desc"></div>
            </div>
        </div>

    </div>
@endsection