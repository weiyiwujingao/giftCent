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
    @include('home.common.header',['title'=>'修改密码','css'=>'1'])
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">当前密码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="text" placeholder=""/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">新密码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="text" placeholder=""/>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">确认新密码：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <input class="weui-input" type="text" placeholder=""/>
            </div>
        </div>
        <div class="weui-cell" style="padding-top: 30px;">
            <button class="weui-btn weui-btn_loading weui-btn_primary" style="width: 80%;"><i class="weui-loading"></i> 确认</button>
        </div>
    </div>
@endsection