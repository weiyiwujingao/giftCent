@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>修改礼品卡类型</h5>
        </div>
        <div class="ibox-content">
            <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
           {{-- <a href="{{route('giftCardType.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 套餐卡类型管理</button></a>--}}
            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
            <form class="form-horizontal m-t-md" action="{{ route('giftCardType.update',$info->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                {!! csrf_field() !!}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">名称：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="name" value="{{$info->name}}" required data-msg-required="请输入套餐卡类型名称">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">价值：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="price" value="{{$info->price}}" required data-msg-required="请输入套餐卡类型价值">
                        @if ($errors->has('price'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('price')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态：</label>
                    <div class="input-group col-sm-2">
                        <select class="form-control" name="status">
                            <option value="0" @if($info->status == 0) selected @endif>不可使用</option>
                            <option value="1" @if($info->status == 1) selected @endif>正常使用</option>
                        </select>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">所属公司：</label>
                    <div class="input-group col-sm-2">
                        <select class="form-control" name="company_id">
                            <option value="">-请选择-</option>
                            @foreach($info['company_list'] as $item)
                            <option value="{{$item['id']}}" @if($item['id'] == $info['company_id']) selected @endif>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('company_id'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('company_id')}}</span>
                        @endif
                    </div>
                </div>
                {{--<div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态：</label>
                    <div class="input-group col-sm-1">
                        <select class="form-control" name="is_online">
                            <option value="1" @if($info->is_online == 1) selected="selected" @endif>线下</option>
                            <option value="2" @if($info->is_online == 2) selected="selected" @endif>线上</option>
                        </select>
                        @if ($errors->has('is_online'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('is_online')}}</span>
                        @endif
                    </div>
                </div>--}}
                <input type="hidden" class="form-control" name="gr_ids" value="{{$info->gr_ids}}" >
                @if ($errors->has('gr_ids'))
                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('gr_ids')}}</span>
                @endif
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
                        <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                        <input type="hidden" name="start_time" value="{{$info->start_time}}">
                        <input type="hidden" name="end_time" value="{{$info->end_time}}">
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
@endsection