@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>添加物流</h5>
            </div>
            <div class="ibox-content">
                {{--<a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                <a href="{{route('express.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 物流管理</button></a>--}}
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{ route('express.store') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">订单号：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" value="{{$orderSn}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">快递单号：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="ex_num" required data-msg-required="请输入快递单号">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">物流公司：</label>
                        <div class="input-group col-sm-2">
                            <select class="form-control" name="ex_id">
                            @foreach($express as $k=>$item)
                                    <option value="{{$item->ex_id}}">{{$item->ex_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="order_sn" value="{{$orderSn}}">
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>　<button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection