@extends('home.layouts.layout')
@section('css')
<link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,order_settlement.css" />
@endsection
@section('content')
    @include('home.common.header',['title'=>'订单结算','backUrl'=>''])
    <div class="order_detail">
        <div class="weui-flex store_title">
            <div class="weui-flex__item">店名名称店名名称店名名称</div>
            <div class="icon"><i class="iconfont icon-icon_delete"></i></div>
        </div>
        <article class="weui-article">
            <div class="weui-flex item">
                <div class="select">
                    <label>
                        <i class="iconfont icon-icon_Select"></i>
                        <input type="checkbox" value="" name="id" class="ckbox">
                    </label>
                </div>
                <div class="left"><img src="/images/default-bg.jpg"/></div>
                <div class="weui-flex__item title">超级好吃的榴莲千层</div>
                <div class="right">
                    <strong>￥168.00</strong>

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
            </div>
            <div class="weui-flex item">
                <div class="select"><i class="iconfont icon-icon_uncheck"></i></div>
                <div class="left"><img src="/images/default-bg.jpg"/></div>
                <div class="weui-flex__item title">超级好吃的榴莲千层超级好吃的榴莲千层超级好吃的榴莲千层超级好吃的榴莲千层</div>
                <div class="right">
                    <strong>￥168.00</strong>

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
            </div>
        </article>
    </div>
    <div class="frm_mess">
        <div class="weui-tab">
            <div class="weui-navbar">
                <div class="weui-navbar__item weui-bar__item_on" data-idx="1">
                    收款码下单
                </div>
                <div class="weui-navbar__item" data-idx="2">
                    验证码下单
                </div>
            </div>
            <div class="weui-tab__panel">
                <div id="nav_cnt_1">
                    <div class="weui-flex skmbx">
                        <div>收款码：</div>
                        <div class="weui-flex__item">
                            <input type="tel" class="weui-input" placeholder="请输入16位数字收款码" maxlength="16">
                        </div>
                    </div>
                    <div class="tips">温馨提示：收款码有效时间为50秒，请快速完成输入</div>
                    <div class="scan">
                        <button class="weui-btn weui-btn_plain-primary" style="width: 40%;">手机扫码</button>
                    </div>
                </div>
                <div id="nav_cnt_2" class="hide">
                    <div class="weui-flex skmbx">
                        <div>请输入手机号：</div>
                        <div class="weui-flex__item">
                            <input type="tel" class="weui-input" placeholder="" maxlength="12">
                        </div>
                    </div>
                    <div class="weui-flex">
                        <div class="weui-flex__item">
                            <div class="weui-flex skmbx">
                                <div>验证码：</div>
                                <div class="weui-flex__item">
                                    <input type="tel" class="weui-input" placeholder="" maxlength="8">
                                </div>
                            </div>
                        </div>
                        <div class="yzmbx">
                            <button class="weui-btn weui-btn_primary">获取验证</button>
                        </div>
                    </div>
                    <div class="weui-flex skmbx">
                        <div>取货人：</div>
                        <div class="weui-flex__item">
                            <input type="text" class="weui-input" placeholder="" maxlength="20">
                        </div>
                    </div>
                    <div class="weui-flex skmbx">
                        <div>取货时间：</div>
                        <div class="weui-flex__item">
                            <input type="text" class="weui-input" id="picktime" placeholder="" maxlength="30" readonly>
                        </div>
                    </div>
                    <div class="tips">温馨提示：请客户先到官网注册成功激活幸福卷，绑定手机号码方可便捷使用。</div>
                </div>
            </div>
        </div>
    </div>
    <div class="weui-flex settlement">
        <div class="weui-flex__item">
            <div class="total">总计：￥<span>610.00</span></div>
        </div>
        <div class="weui-btn weui-btn_primary">结算</div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $('.weui-navbar__item').on('click', function () {
                var idx = $(this).data('idx');
                $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
                $("div[id^='nav_cnt_']").addClass('hide');
                $('#nav_cnt_' + idx).removeClass('hide');
            });
            $('#picktime').click(function () {
                var dates = [], d1 = ['2018-11-02  周五', '2018-11-03  周六', '2018-11-04  周日'],
                        hours = [], d2 = ['10:30-12:30', '14:00-16:00', '16:00-19:00', '19:00-21:00'],
                        $this = $(this);
                for (i in d1) {
                    dates.push({
                        label: d1[i],
                        value: d1[i]
                    });
                }
                for (i in d2) {
                    hours.push({
                        label: d2[i],
                        value: d2[i]
                    });
                }
                weui.picker(dates, hours, {
                    defaultValue: [dates[0]['label'], hours[0]['label']],
                    onChange: function (result) {
                        //console.log(result);
                    },
                    onConfirm: function (result) {
                        $this.val(result[0] + ' ' + result[1]);
                    }
                });
            });
        });
    </script>
@endsection