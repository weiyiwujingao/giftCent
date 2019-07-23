@extends('home.layouts.layout')
@section('css')
<link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,user_index.css" />
@endsection
@section('content')
    @include('home.common.header',['title'=>'我的信息'])
    <div class="wrap">
        <div class="weui-flex my_mess">
            <div class="weui-flex__item logo">
                <img src="/images/default-bg.jpg">
            </div>
            <div class="weui-flex__item text">
                <div class="weui-flex">
                    <div class="label">商户代码：</div>
                    <div class="weui-flex__item">test001</div>
                </div>
                <div class="weui-flex">
                    <div class="label">商户名称：</div>
                    <div class="weui-flex__item">幸福加焙测试虚拟用店</div>
                </div>
                <div class="weui-flex">
                    <div class="label">商户地址：</div>
                    <div class="weui-flex__item">No 159, xingfu road No 159, xingfu road</div>
                </div>
            </div>
        </div>
        <div class="weui-cells bdcells">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-update"></i> 修改密码</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-icon_Telephone"></i> 幸福热线：400-1363-778</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
        </div>
        <div class="weui-cells bdcells">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-weixin"></i> 已绑定微信：xiaoJun</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-weixin"></i> 绑定微信2</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-weixin"></i> 绑定微信3</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
        </div>
        <div class="weui-cells bdcells">
            <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__bd">
                    <p><i class="iconfont icon-my_icon_exit"></i> 退出登录</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
        </div>
    </div>
    @include('home.common.foot_menu',['idx'=>3])
@endsection