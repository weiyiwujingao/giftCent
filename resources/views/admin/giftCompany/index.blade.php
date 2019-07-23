@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>公司列表</h5>
        </div>
        <div class="ibox-content">
            {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>--}}
            <a href="{{route('giftCompany.create')}}" link-url="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加公司</a>
            <form method="post" action="{{route('giftCompany.index')}}" name="form">
                {!! csrf_field() !!}
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="text-center" width="10">ID</th>
                        <th>名称</th>
                        <th>英文名</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companyList as $k => $item)
                        <tr>
                            <td class="text-center">{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->en_name}}</td>
                            <td>{{$item->create_time}}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="text-navy">正常</span>
                                @elseif($item->status == 2)
                                    <span class="text-danger">删除</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('giftCompany.edit',$item->id)}}">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    @if($item->status == 2)
                                            <a href="{{route('giftCompany.status',['status'=>1,'id'=>$item->id])}}"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    @else
                                            <a href="{{route('giftCompany.status',['status'=>2,'id'=>$item->id])}}"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 删除</button></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$companyList->links()}}
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
