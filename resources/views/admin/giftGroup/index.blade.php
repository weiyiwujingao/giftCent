@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>套餐列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    <a href="{{route('giftGroup.create')}}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加套餐</a>
                    {{--<a href="{{route('giftCardType.create')}}" id="addGift" class="btn btn-info btn-sm"><i class="fa fa-external-link"></i> 添加礼品卡类型</a>--}}
                </div>
                <div class="h-right">
                    <form method="get" action="{{route('giftGroup.index')}}" name="form">
                    <label>
                        <input type="text" placeholder="套餐名称" class="form-control" name="name" @if(isset($search['name']))value="{{$search['name']}}"@endif>
                    </label>
                    <label>
                        <input type="text" placeholder="添加开始日期" id="start_time" autocomplete="off" class="form-control" name="start_time" @if(isset($search['start_time']))value="{{$search['start_time']}}"@endif>
                    </label>
                    <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                    <label style="display: inline-block;">
                        <input type="text" placeholder="添加结束日期" id="end_time" autocomplete="off" class="form-control" name="end_time" @if(isset($search['end_time']))value="{{$search['end_time']}}"@endif>
                    </label>

                    <label>
                        <select class="form-control" name="status">
                            <option value="-1" @if(isset($search['status']) && $search['status'] == '-1') selected @endif>-状态-</option>
                            <option value="1" @if(isset($search['status']) && $search['status'] == '1') selected @endif>正常</option>
                            <option value="2" @if(isset($search['status']) && $search['status'] == '2') selected @endif >隐藏</option>
                        </select>
                    </label>
                    <label>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                    </label>
                    </form>
                </div>
            </div>
            <form method="post" action="{{route('giftGroup.index')}}" name="form">
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="bs-checkbox " style="width: 36px; " data-field="state" tabindex="0">
                                <input type="checkbox" name="all_list" class="checkbox" id="all_list">
                        </th>
                        <th class="text-center" width="10">ID</th>
                        <th>套餐名称</th>
                        <th>市场价</th>
                        <th>商品组合</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $k => $item)
                        <tr>
                            <td class="bs-checkbox"><input type="checkbox" name="checkboxes[]" value="{{$item->id}}" class="checkbox"></td>
                            <td class="text-center">{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>￥{{$item->price}}</td>
                            <td><a href="#" class="view-page" data-link="{{route('giftGoods.index',['gs_ids'=>$item->gs_ids])}}">{{$item->goodlist}}</a></td>
                            <td>{{$item->create_time}}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="text-navy">正常</span>
                                @elseif($item->status == 2)
                                    <span class="text-danger">下架</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('giftGroup.edit',$item->id)}}">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    @if($item->status == 2)
                                            <a href="{{route('giftGroup.status',['status'=>1,'id'=>$item->id])}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    @else
                                            <a href="{{route('giftGroup.status',['status'=>2,'id'=>$item->id])}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                    @endif
                                    <a href="{{route('giftGroup.delete',$item->id)}}"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if(!$groups->count())
                        <tr>
                            <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{$groups->links()}}
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
@section('footer-js')
    <link href="{{loadEdition('/js/jedate/skin/jedate.css')}}" rel="stylesheet">
    <script src="{{loadEdition('/js/jedate/jedate.min.js')}}"></script>
    <script type="text/javascript">
        //全选切换效果
        $(document).on("click", "input[name='all_list']", function () {
            if ($(this).prop("checked") == true) {
                $("td").find("input[type='checkbox']").prop("checked", true);
            } else {
                $("td").find("input[type='checkbox']").prop("checked", false);
            }
        });
        function execUser() {
            var ids = '';
            $("td").find("input[name='checkboxes[]']:checked").each(function (i) {
                var id = $(this).val();
                ids += id + ',';
            });
            return ids;
        }
        $(function () {
            /*$("#addGift").click(function () {
                var actionUrl = "{{route('giftCardType.create')}}";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的套餐', function () {
                        return false;
                    });
                    return false;
                }
                window.location.href = actionUrl + '?ids=' + ids;
            });*/
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
            $('.view-page').on('click', function (e) {
                e.preventDefault();
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
    </script>
@endsection
