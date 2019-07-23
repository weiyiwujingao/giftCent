@extends('home.layouts.layout')
@section('css')
    <style>
        body {
            background: #eee;
        }

        .weui-cells {
            margin-top: 60px;
        }
    </style>
@endsection
@section('content')
    @include('home.common.header',['title'=>'商户管理中心','css'=>'1','ritCnt'=>'<i class="weui-icon-info" id="warnBtn"></i>'])
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">商户代码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="text" placeholder=""/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">登录密码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="password" placeholder="不小于6位，区分大小写"/>
            </div>
        </div>
        <div class="weui-cell weui-cell_vcode">
            <div class="weui-cell__hd"><label class="weui-label">验证码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="text" placeholder="请输入验证码"/>
            </div>
            <div class="weui-cell__ft">
                <img class="weui-vcode-img" src="//weui.io/images/vcode.jpg">
            </div>
        </div>
        <div class="weui-cell" style="padding-top: 30px;">
            <button class="weui-btn weui-btn_primary" style="width: 80%;">登录</button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $('#warnBtn').click(function () {
                weui.alert('如有忘记密码，请直接找客服。');
            });
        });
    </script>
@endsection