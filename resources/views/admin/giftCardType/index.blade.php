@extends('admin.layouts.layout')
@section('content')
    <style>
        .fa-check{
            color: green;
        }
        .fa-close{
            color: red;
        }
    </style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>礼品卡类型列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>--}}
                    <a href="{{route('giftCardType.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加礼品卡类型</a>
                </div>
                <div class="h-right">
                    <form method="get" action="{{route('giftCardType.index')}}" name="form">
                        <label>
                            <input type="text" placeholder="名称" class="form-control" name="name" @if(isset($search['name']))value="{{$search['name']}}"@endif>
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
                                <option value="1" @if(isset($search['status']) && $search['status'] == '1') selected @endif >正常使用</option>
                                <option value="0" @if(isset($search['status']) && $search['status'] == '0') selected @endif>不可使用</option>
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
                    <th class="text-center" width="10">ID</th>
                    <th>名称</th>
                    <th>套餐组合</th>
                    <th>价值</th>
                    <th>所属公司</th>
                    <th>有效期</th>
                    <th>卡数量</th>
                    <th>已使用卡数量</th>
                    <th>添加时间</th>
                    <th>状态</th>
                    {{--<th>类型</th>--}}
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $k => $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td><div style="max-width: 450px;word-break: break-all;"><a href="#" class="view-page" data-link="{{route('giftGroup.index',['gr_ids'=>$item->gr_ids])}}">{{$item->grouplist}}</a></div></td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->company->name}}</td>
                        <td>{{date('Y-m-d H:i:s',$item->start_time)}} ~ {{date('Y-m-d H:i:s',$item->end_time)}}</td>
                        <td><a href="#" class="view-page" data-link="{{route('gifts.index',['cty_id'=>$item->id])}}">{{$item->card_count}}</a></td>
                        <td><a href="#" class="view-page" data-link="{{route('gifts.index',['cty_id'=>$item->id,'status'=>1])}}">{{$item->use_count}}</a></td>
                        <td>{{$item->create_time}}</td>
                        <td align="center">
                            @if($item->status == 1)
                                <i class="fa fa-check" title="正常使用"></i>
                            @else
                                <i class="fa fa-close" title="不可使用"></i>
                            @endif
                        </td>
                        </td>
                        {{--<td>
                            @if($item->is_online == 1)
                                <span class="text-navy">线下</span>
                            @elseif($item->is_online == 2)
                                <span class="text-danger">线上</span>
                            @endif
                        </td>--}}
                        <td class="oprate">
                            <div class="btn-group">
                                <a href="{{route('giftCardType.edit',$item->id)}}">
                                    <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-edit"></i> 修改</button>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{route('gifts.create',['id'=>$item->id])}}">
                                    <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 发放</button>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('giftCardType.explodeData') }}?id={{$item->id}}">
                                    <button class="btn btn-success btn-xs" type="button"><i class="fa fa-file-excel-o"></i> 导出</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(!$list->count())
                    <tr>
                        <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{$list->links()}}
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">

</script>
@endsection
@section('footer-js')
    <link href="{{loadEdition('/js/jedate/skin/jedate.css')}}" rel="stylesheet">
    <script src="{{loadEdition('/js/jedate/jedate.min.js')}}"></script>
    <script>
        //全选切换效果
        $(document).on("click","input[name='all_list']",function(){
            if($(this).prop("checked") == true){
                $("td").find("input[type='checkbox']").prop("checked",true);
            }else{
                $("td").find("input[type='checkbox']").prop("checked",false);
            }
        });
        function execUser() {
            var ids = '';
            $("td").find("input[name='checkboxes[]']:checked").each(function(i){
                var id = $(this).val();
                ids += id + ',';
            });
            return ids;
        }
        $(function () {
            $("#addGift").click(function () {
                var actionUrl = "{{route('giftGroup.create')}}";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的商品', function () {
                        return false;
                    });
                    return false;
                }
                window.location.href = actionUrl + '?ids=' + ids;
            });

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
