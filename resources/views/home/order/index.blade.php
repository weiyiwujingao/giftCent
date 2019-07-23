@extends('home.layouts.layout')
@section('css')
    <link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,order_index.css"/>
@endsection
@section('content')
    @include('home.common.header',['title'=>'订单管理','backUrl'=>'/home/index/index','ritCnt'=>'<i class="weui-icon-search" id="searchBtn"></i>'])
    <div id="app">
        <div class="weui-flex order_menu">
            <div class="weui-flex__item" :class="{ 'active' : type == 0}" data-location="/home/order/index">全部</div>
            <div class="weui-flex__item" :class="{ 'active' : type == 1}" data-location="?type=1">今日</div>
            <div class="weui-flex__item" :class="{ 'active' : type == 2}" data-location="?type=2">待确认</div>
            <div class="weui-flex__item" :class="{ 'active' : type == 3}" data-location="?type=3">待退货</div>
            <div class="weui-flex__item" :class="{ 'active' : type == 4}" data-location="?type=4">已退货</div>
        </div>
        <div id="searchbx">
            <div class="weui-flex">
                <div class="weui-flex__item">
                    <input type="text" placeholder="开始日期" class="weui-input datePicker" readonly>
                </div>
                <div class="weui-flex__item">
                    <input type="text" placeholder="结束日期" class="weui-input datePicker" readonly>
                </div>
                <div class="schbtn">
                    <button class="weui-btn weui-btn_mini weui-btn_primary">搜索</button>
                </div>
            </div>
        </div>
        <div class="search_bg" onclick="cancelSearch();"></div>
        <div class="order_list">
            <article class="weui-article">
                <h3>订单号：15800909247</h3>
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <h3>收货人：李三</h3>
                    </div>
                    <div class="weui-flex__item">
                        <h3>手机：<a href="tel:15800909247">15800909247 {{--<i class="iconfont icon-icon_Telephone"></i>--}}</a></h3>
                    </div>
                </div>
                <div data-location="/home/order/detail">
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
                    <div class="weui-flex foot">
                        <div class="weui-flex__item title">时间：2018.10.30 17:20</div>
                        <div class=" title right">总价：￥520.00</div>
                    </div>
                </div>
                <div class="oprate_bx">
                    <button class="weui-btn weui-btn_mini weui-btn_primary">确认提货</button>
                </div>
            </article>
            <article class="weui-article">
                <h3>订单号：15800909247</h3>
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <h3>收货人：李三</h3>
                    </div>
                    <div class="weui-flex__item">
                        <h3>手机：<a href="tel:15800909247">15800909247 {{--<i class="iconfont icon-icon_Telephone"></i>--}}</a></h3>
                    </div>
                </div>
                <div data-location="/home/order/detail">
                    <div class="weui-flex item">
                        <div class="left"><img src="/images/default-bg.jpg"/></div>
                        <div class="weui-flex__item title">超级好吃的榴莲千层</div>
                        <div class="right">
                            <strong>￥168.00</strong>
                            <i>数量： x2</i>
                        </div>
                    </div>
                    <div class="weui-flex foot">
                        <div class="weui-flex__item title">时间：2018.10.30 17:20</div>
                        <div class=" title right">总价：￥520.00</div>
                    </div>
                </div>
                <div class="oprate_bx">
                    <button class="weui-btn weui-btn_mini weui-btn_warn refund">已申请退货</button>
                    <button class="weui-btn weui-btn_mini weui-btn_primary confirm">确认提货</button>
                </div>
            </article>
            <div class="weui-loadmore" v-if="loading">
                <i class="weui-loading"></i>
                <span class="weui-loadmore__tips">正在加载</span>
            </div>
            <div class="weui-loadmore weui-loadmore_line" v-if="noData">
                <span class="weui-loadmore__tips nobg">到底啦~</span>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                type: 1,
                loading: false,
                noData: false
            },
            created: function () {
                var params = getUrlParams();
                this.type = params.type ? params.type : 0;
            },
            methods: {}
        })
        function cancelSearch() {
            $('#searchbx,.search_bg').hide();
        }
        $(function () {
            $('#searchBtn').click(function () {
                var dispaly = $('#searchbx').css('display');
                if (dispaly == 'none') {
                    $('#searchbx,.search_bg').show();
                } else {
                    cancelSearch();
                }
            });
            $('.datePicker').focus(function () {
                var $this = $(this), date = new Date(), year = date.getFullYear(), month = date.getMonth();
                weui.datePicker({
                    start: 2016,
                    end: year,
                    defaultValue: [year, month, 1],
                    onChange: function (result) {
                        // console.log(result);
                    },
                    onConfirm: function (result) {
                        //console.log(result);
                        $this.val(result[0] + '-' + result[1] + '-' + result[2]);
                    }
                });
            });
            $('button.refund').click(function () {
                weui.picker([
                    {
                        label: '同意退货',
                        value: 1
                    },
                    {
                        label: '不同意退货',
                        value: 0
                    }
                ], {
                    className: 'custom-classname',
                    container: 'body',
                    defaultValue: [1],
                    onChange: function (result) {
                        //console.log(result)
                    },
                    onConfirm: function (result) {
                        console.log(result)
                    }
                });
            });
            $('button.confirm').click(function () {
                weui.confirm('是否确认完成订单？', function () {
                    console.log('yes')
                }, function () {
                    console.log('no')
                });
            });
        });
    </script>
@endsection