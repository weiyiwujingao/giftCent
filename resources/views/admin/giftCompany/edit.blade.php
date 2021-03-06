@extends('admin.layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>编辑公司</h5>
        </div>
        <div class="ibox-content">
            <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
            <a href="{{route('giftCompany.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 公司管理</button></a>
            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
            <form class="form-horizontal m-t-md" action="{{ route('giftCompany.update',$company->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                {!! csrf_field() !!}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">名称：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="name" value="{{$company->name}}" required data-msg-required="请输入公司名称">
                        @if ($errors->has('name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">英文名：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="en_name" value="{{$company->en_name}}" required data-msg-required="请输入公司英文名">
                        @if ($errors->has('en_name'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('en_name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态：</label>
                    <div class="input-group col-sm-1">
                        <select class="form-control" name="status">
                            <option value="1" @if($company->status == 1) selected="selected" @endif>显示</option>
                            <option value="2" @if($company->status == 2) selected="selected" @endif>删除</option>
                        </select>
                        @if ($errors->has('status'))
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('status')}}</span>
                        @endif
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
                        <button class="btn btn-white" type="reset"><i class="fa fa-repeat"></i> 重 置</button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
@endsection