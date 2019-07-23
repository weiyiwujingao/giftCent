@extends('home.layouts.layout')
@section('css')
    <style>
        .weui-cells {
            margin-top: 60px;
        }

        .weui-select {
            color: #666;
        }

        .weui-cell__bd {
            color: #666;
            font-size: 0.9rem;
        }

        .weui-agree__checkbox:checked:before {
            font-size: 1.2rem;
        }
        .datePicker{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    @include('home.common.header',['title'=>'店铺设置','css'=>'1','ritCnt'=>'<i class="weui-icon-info" id="warnBtn"></i>'])
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">营业时间：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <input class="weui-input datePicker" type="text" value="" placeholder="开店时间" readonly>
                    </div>
                    <div class="weui-flex__item" style="color: #aaa;text-align: center;">至</div>
                    <div class="weui-flex__item">
                        <input class="weui-input datePicker" type="text" value="" placeholder="闭店时间" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">取货时间：</label></div>
            <div class="weui-cell__bd weui-cell_primary">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <input class="weui-input datePicker" type="text" value="" placeholder="开始时间" readonly>
                    </div>
                    <div class="weui-flex__item" style="color: #aaa;text-align: center;">至</div>
                    <div class="weui-flex__item">
                        <input class="weui-input datePicker" type="text" value="" placeholder="结束时间" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd"><label class="weui-label">门店状态：</label></div>
            <div class="weui-cell__bd">
                <select class="weui-select" name="select2">
                    <option value="1"> 正常运行</option>
                    <option value="0"> 闭店</option>
                </select>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">配送方式：</label></div>
            <div class="weui-cell__bd">
                <div class="weui-flex">
                    <div class="weui-flex__item">
                        <label><input type="checkbox" class="weui-agree__checkbox"/> 门店自提</label>
                    </div>
                    <div class="weui-flex__item">
                        <label><input type="checkbox" class="weui-agree__checkbox"/> 商户配送</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-cell">
            <div class="weui-cell__hd"><label class="weui-label">门店公告：</label></div>
            <div class="weui-cell__bd">
                <textarea class="weui-textarea" placeholder="请输入文本，100字符以内" rows="3"></textarea>

                <div class="weui-textarea-counter"><span>0</span>/100</div>
            </div>
        </div>
        <div class="weui-cell" style="padding-top: 30px;">
            <button class="weui-btn weui-btn_loading weui-btn_primary" style="width: 80%;"><i class="weui-loading"></i>
                保存
            </button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $('#warnBtn').click(function () {
                weui.alert('闭店时间大于或等于24点时，<br/>请设置为 23:59 。');
            });
            $('.datePicker').focus(function () {
                var hours = [], minutes = [], $this = $(this), val = $this.val();
                for (var i = 0; i <= 23; i++) {
                    var v = i < 10 ? '0' + i : i + '';
                    hours.push({
                        label: v,
                        value: v
                    });
                }
                for (var i = 0; i < 60; i++) {
                    var v = i < 10 ? '0' + i : i + '';
                    minutes.push({
                        label: v,
                        value: v
                    });
                }
                var defaultVal = ['08', '00'];
                if (val != '') {
                    defaultVal = val.split(':');
                }
                weui.picker(hours, [{label: ':', value: ':'}], minutes, {
                    defaultValue: [defaultVal[0], ':', defaultVal[1]],
                    onChange: function (result) {
                        //console.log(result);
                    },
                    onConfirm: function (result) {
                        $this.val(result[0] + ':' + result[2]);
                    }
                });
            });

        });

    </script>
@endsection