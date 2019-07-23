@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>礼品卡管理</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    <a href="{{route('giftCardType.index')}}" link-url="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加礼品卡</a>
                </div>
                <div class="h-right">
                    <form method="get" action="{{route('gifts.index')}}" name="form">
                        <label>
                            <input type="text" placeholder="卡号" class="form-control" name="card_sn" @if(isset($search['card_sn']))value="{{$search['card_sn']}}"@endif>
                        </label>

                        <label>
                            <input type="text" placeholder="有效期开始日期" id="start_time" autocomplete="off" class="form-control" name="start_time" @if(isset($search['start_time']))value="{{$search['start_time']}}"@endif>
                        </label>
                        <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                        <label style="display: inline-block;">
                            <input type="text" placeholder="有效期结束日期" id="end_time" autocomplete="off" class="form-control" name="end_time" @if(isset($search['end_time']))value="{{$search['end_time']}}"@endif>
                        </label>

                        <label>
                            <select class="form-control" name="status">
                                <option value="-1">-状态-</option>
                                <option value="0" @if(isset($search['status']) && $search['status'] == 0) selected @endif>未使用</option>
                                <option value="1" @if(isset($search['status']) && $search['status'] == 1) selected @endif>已使用</option>
                                <option value="2" @if(isset($search['status']) && $search['status'] == 2) selected @endif>已过期</option>
                            </select>
                        </label>
                        <label>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索
                            </button>
                        </label>
                     </form>
                </div>

            </div>
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="text-center" width="10">ID</th>
                        <th>卡号</th>
                        <th>礼品卡类型</th>
                        <th>价值</th>
                        {{--<th>公司名称</th>
                        <th>公司英文名称</th>
                        <th>用户名称</th>
                        <th>手机号码</th>
                        <th>收货地址</th>--}}
                        <th>有效期</th>
                        <th>添加时间</th>
                        <th>关联订单</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gifts as $k => $item)
                        <tr>
                            <td class="text-center">{{$item->id}}</td>
                            <td>{{$item->card_sn}}</td>
                            <td>{{$item->cardType->name}}</td>
                            <td>￥{{$item->cardType->price}}</td>
                            {{--<td>{{$item->company->name}}</td>
                            <td>{{$item->company->en_name}}</td>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->user_mobile}}</td>
                            <td>{{$item->user_address}}</td>--}}
                            <td>{{date('Y-m-d H:i:s',$item->start_time)}} ~ {{date('Y-m-d H:i:s',$item->end_time)}}</td>
                            <td>{{$item->create_time}}</td>
                            <td>
                                @if($item->status == 1 && isset($item->order))
                                    <a href="{{route('order.index',['order_sn'=>$item->order->order_sn])}}">{{$item->order->order_sn}}</a>
                                 @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status == 0)
                                    <span class="text-navy">未使用</span>
                                @elseif($item->status == 1)
                                    <span class="text-danger">已使用</span>
                                @elseif($item->status == 2)
                                    <span class="text-danger">已过期</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if(!$gifts->count())
                        <tr>
                            <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
              {{$gifts->links()}}
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
        });
    </script>
@endsection