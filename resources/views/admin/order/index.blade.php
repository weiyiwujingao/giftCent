@extends('admin.layouts.layout')
@section('content')
<style>
    .status-0{
        color: red;
    }
    .status-1{
        color: #23c6c8;
    }
    .status-2 {
        color: green;
    }
    .status-3 {
        color: #ccc;
    }
    .remark{
        border-radius: 5px;
        padding: 5px;
        border: 1px dashed #ccc;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>订单列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">

                </div>

                <div class="h-right">
                    <form method="get" action="{{route('order.index')}}" name="form">
                        <label>
                            <input type="text" placeholder="订单号" class="form-control" name="order_sn" @if(isset($search['order_sn']))value="{{$search['order_sn']}}"@endif>
                        </label>
                        <label>
                            <input type="text" placeholder="用户手机号码" class="form-control" name="user_mobile" @if(isset($search['user_mobile']))value="{{$search['user_mobile']}}"@endif>
                        </label>
                        <label>
                            <input type="text" placeholder="订单开始日期" id="start_time" autocomplete="off" class="form-control" name="start_time" @if(isset($search['start_time']))value="{{$search['start_time']}}"@endif>
                        </label>
                        <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                        <label style="display: inline-block;">
                            <input type="text" placeholder="订单结束日期" id="end_time" autocomplete="off" class="form-control" name="end_time" @if(isset($search['end_time']))value="{{$search['end_time']}}"@endif>
                        </label>
                        <label>
                            <select class="form-control" name="status">
                                <option value="-1">-订单状态-</option>
                                @foreach($allStatus as $key=>$val)
                                <option value="{{$key}}" @if(isset($search['status']) && $search['status'] == $key) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                        </label>
                    </form>
                </div>

            </div>
            <table class="table table-striped table-bordered table-hover m-t-md">
                <thead>
                <tr>
                   {{-- <th class="text-center" width="10">ID</th>--}}
                    <th>订单号</th>
                    <th>下单时间</th>
                    <th>收货信息</th>
                    <th>使用卡号</th>
                    <th>选取套餐</th>
                    {{--<th>所属公司</th>--}}
                    <th class="text-center">订单状态</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderList as $k => $item)
                    <tr>
                        {{--<td class="text-center">{{$item->id}}</td>--}}
                        <td>{{$item->order_sn}}</td>
                        <td>{{$item->create_time}}</td>
                        <td>
                            <p><span>{{$item->user_name}}</span> <span>{{$item->user_mobile}}</span></p>
                            <p>{{$item->user_address_all}}</p>
                            @if($item->remark != '')
                            <p class="remark">备注：{{$item->remark}}</p>
                            @endif
                        </td>
                        <td>
                            <p>{{$item->card->card_sn}}</p>
                            <p>{{$item->card->gname}} (￥{{$item->card->gprice}})</p>
                        </td>
                        <td><a href="javascript:;" class="view-page" data-link="{{route('giftGoods.index',['gs_ids'=>$item->groupGoods->gs_ids])}}">{{$item->groupGoods->name}}</a></td>
                        {{--<td></td>--}}
                        <td  class="text-center status-{{$item->status}}">{{$allStatus[$item->status]}}</td>
                        <td class="oprate">
                            @if($item->status == 0)
                                <button class="btn btn-primary btn-sm change-status" data-id="{{$item->order_id}}" data-val="1" data-status="{{$item->status}}" type="button"><i class="fa fa-send-o"></i> 发货</button>
                                <button class="btn btn-danger btn-sm change-status" data-id="{{$item->order_id}}" data-val="3" data-status="{{$item->status}}" type="button"><i class="fa fa-warning"></i> 取消</button>
                            @endif
                            @if($item->status < 3)
                                @if($item->status == 1)
                                  <button class="btn btn-primary btn-sm change-status" data-id="{{$item->order_id}}" data-val="2" data-status="{{$item->status}}" type="button"><i class="fa fa-check-circle"></i> 完成收货</button>
                                @endif
                                @if(empty($item->express))
                                    <a href="javascript:;" class="btn btn-info btn-sm add-express" data-sn="{{$item->order_sn}}"><i class="fa fa-plus-circle"></i> 添加物流</a>
                                @else
                                    <a href="javascript:;"  class="btn btn-info btn-sm view-page" data-link="{{route('express.index',['order_sn'=>$item->order_sn])}}"><i class="fa fa-eye"></i> 查看物流</a>
                                @endif
                             @else
                               <span class="status-3"> ——</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if(!$orderList->count())
                    <tr>
                        <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$orderList->links()}}
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
@section('footer-js')
    <link href="{{loadEdition('/js/jedate/skin/jedate.css')}}" rel="stylesheet">
    <script src="{{loadEdition('/js/jedate/jedate.min.js')}}"></script>
    <script>
        $(function () {
            jeDate("#start_time", {
                theme: {bgcolor: "#00A1CB", color: "#ffffff", pnColor: "#00CCFF"},
                format: "YYYY-MM-DD",
                isTime: true,
            });
            jeDate("#end_time", {
                theme: {bgcolor: "#00A1CB", color: "#ffffff", pnColor: "#00CCFF"},
                format: "YYYY-MM-DD",
                isTime: true,
            });
            $('.change-status').on('click', function () {
                var $this = $(this),
                        title = $.trim($this.text());
                layer.confirm('确认“' + title + '”操作？', function () {
                    var orderId = $this.data('id'),
                            _status = $this.data('status'),
                            _val = $this.data('val');
                    var token = $('meta[name="csrf-token"]').attr('content');
                    var load = layer.load();
                    $.ajax({
                        url: '/admin/Order/changeStatus',
                        type: 'POST',
                        sync: 'true',
                        contentType: 'application/x-www-form-urlencoded',
                        data: {order_id: orderId, status: _status, val: _val},
                        headers: {'X-CSRF-TOKEN': token},
                        dataType: 'json',
                        success: function (res) {
                            if (res.status == 1) {
                                location.reload();
                            } else {
                                layer.alert(res.message || '操作失败！');
                            }
                        },
                        error: function () {
                            layer.alert('网络异常，操作失败！');
                        },
                        complete: function () {
                            layer.close(load);
                        }
                    });
                });
            });
            $('.add-express').on('click', function () {
                var orderSn = $(this).data('sn');
                layer.open({
                    type: 2,
                    title: '填写物流信息',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['80%', '60%'],
                    content: '/admin/express/create?order_sn=' + orderSn
                });
            });
            $('.view-page').on('click', function () {
                var link = $(this).data('link');
                var _title = $.trim($(this).text());
                layer.open({
                    type: 2,
                    title: _title,
                    shadeClose: true,
                    shade: 0.8,
                    area: ['80%', '90%'],
                    content: link
                });
            });
        });
        function addExpress(order_sn){
            var actionUrl = "{{route('express.create')}}";
            if (order_sn == '') {
                layer.msg('请选择订单！', function () {
                    return false;
                });
                return false;
            }
            window.location.href = actionUrl + '?order_sn=' + order_sn;
        }
    </script>
@endsection