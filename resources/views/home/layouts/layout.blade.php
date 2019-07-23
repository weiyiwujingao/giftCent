<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>商户管理中心</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=weui.min.css,iconfont.css,common.css"/>
    @yield('css')
</head>
<body>
<div class="page">
    <div class="page__bd" style="height: 100%;">
        <div class="weui-tab">
            <div class="weui-tab__panel">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<script src="{{loadEdition('/js/zepto.min.js')}}"></script>
<script src=//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js></script>
<script src="//res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script>
    $(function () {
        $('[data-location]').on('click', function () {
            var link = $(this).data('location');
            if (link) {
                window.location.href = link;
            }
        });
    });
    function goBack(backUrl) {
        if (backUrl) {
            window.location = backUrl;
        } else {
            window.history.back();
        }
    }
    function getUrlParams() {
        var location = window.location.href,
                tmparr = location.split('?'),
                getParams = {};
        if (tmparr.length > 1) {
            for (i in tmparr) {
                if (tmparr[i].indexOf('=') > 0) {
                    var arr = tmparr[i].split('=');
                    getParams[arr[0]] = arr[1];
                }
            }
        }
        return getParams;
    }
    function showLoad(str) {
        weui.loading(str || '正在加载...');
    }
    function hideLoad() {
        weui.loading().hide();
    }
</script>
@yield('js')
</body>
</html>