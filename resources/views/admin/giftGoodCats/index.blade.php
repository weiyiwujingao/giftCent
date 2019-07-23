@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>商品类别列表</h5>
        </div>
        <div class="ibox-content">
            {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>--}}
            <a href="{{route('giftGoodCats.create')}}" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 添加商品类别</button></a>
            <form method="post" action="{{route('giftGoodCats.index')}}" name="form">
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th>类别名称</th>
                        <th>类型</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cats as $k => $item)
                        <tr>
                            {{--<td class="text-center">{{$item->id}}</td>--}}
                            <td>{{$item->name}}</td>
                            <td>
                                @if($item->parent_id == 0)
                                    <span class="text-navy">一级分类</span>
                                @else
                                    <span class="text-danger">子类</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group oprate">
                                    <a href="{{route('giftGoodCats.edit',$item->id)}}">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    @if($item->status == 2)
                                            <a href="{{route('giftGoodCats.status',['status'=>1,'id'=>$item->id])}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    @else
                                            <a href="{{route('giftGoodCats.status',['status'=>2,'id'=>$item->id])}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                    @endif
                                    <a href="{{route('giftGoodCats.delete',$item->id)}}"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                </div>
                            </td>
                        </tr>
                        @if($item->parent_id == 0)
                            @foreach($item->cats as $key => $value)
                                <tr>
                                    {{--<td class="text-center">{{$value->id}}</td>--}}
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <span class="text-danger">子类</span>
                                    </td>
                                    <td>
                                        <div class="btn-group oprate">
                                            <a href="{{route('giftGoodCats.edit',$value->id)}}">
                                                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                            </a>
                                            @if($value->status == 2)
                                                <a href="{{route('giftGoodCats.status',['status'=>1,'id'=>$value->id])}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                            @else
                                                <a href="{{route('giftGoodCats.status',['status'=>2,'id'=>$value->id])}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                            @endif
                                            <a href="{{route('giftGoodCats.delete',$value->id)}}"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{$cats->links()}}
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection