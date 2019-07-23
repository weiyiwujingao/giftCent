<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>商户管理中心</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="//res.wx.qq.com/open/libs/weui/1.1.3/weui.min.css" rel="stylesheet">
    <link href="<?php echo e(loadEdition('/font/iconfont.css')); ?>" rel="stylesheet">
    <style>
        .page {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .weui-tab__panel {
            padding-bottom: 60px;
        }
    </style>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
<div class="page">
    <div class="page__bd" style="height: 100%;">
        <div class="weui-tab">
            <div class="weui-tab__panel">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(loadEdition('/js/zepto.min.js')); ?>"></script>
<script type="text/javascript" src="//res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="//res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>