<?php $__env->startSection('css'); ?>
    <style>
        .top_menu {
            padding: 20px 0;
            background: #64A6FF;
            color: #fff;
            font-size: 1rem;
        }

        .top_menu .iconfont {
            font-size: 3.2rem;
            display: block;
        }

        .cn_state {
            font-size: 0.8rem;
            color: #444;
            font-weight: bold;
            margin-top: 20px;
            padding-bottom: 10px;
            -moz-box-shadow: 0px 6px 2px #eee;
            -webkit-box-shadow: 0px 6px 2px #eee;
            box-shadow: 0px 6px 2px #eee;;
        }

        .weui-flex {
            text-align: center;
        }

        .cn_state .first-child {
            position: relative;
        }

        .cn_state .first-child:after {
            content: '';
            height: 80%;
            position: absolute;
            right: 0;
            top: 10%;
            background: #eee;
            width: 1px;
            overflow: hidden;
        }

        .cn_state strong {
            display: block;
            color: #64A6FF;
        }

        .cnt_bx {
            color: #333;
            font-size: 0.8rem;
        }

        .cnt_bx .weui-flex {
            margin-top: 50px;
        }

        .cnt_bx .iconfont {
            color: #64A6FF;
            font-size: 3rem;
            display: block;
        }

        .foot_menu .iconfont {
            display: block;
            font-size: 1.2rem;;
        }

        .foot_menu .weui-tabbar__label {
            font-size: 0.6rem;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="weui-flex top_menu">
        <div class="weui-flex__item"><i class="iconfont icon-icon_today"></i> 今日订单</div>
        <div class="weui-flex__item"><i class="iconfont icon-icon_History"></i> 历史订单</div>
        <div class="weui-flex__item"><i class="iconfont icon-icon_cancel"></i> 已取消订单</div>
    </div>
    <div class="weui-flex cn_state">
        <div class="weui-flex__item first-child">
            <strong>￥500.00</strong>
            今日营业额
        </div>
        <div class="weui-flex__item">
            <strong>10</strong>
            今日有效订单
        </div>
    </div>
    <div class="cnt_bx">
        <div class="weui-flex">
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                商品管理
            </div>
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                店铺设置
            </div>
            <div class="weui-flex__item">
                <i class="iconfont icon-tab_icon_Order"></i>
                配送管理
            </div>
        </div>
        <div class="weui-flex">
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
        </div>
    </div>
    <?php echo $__env->make('home.common.foot_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>