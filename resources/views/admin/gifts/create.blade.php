@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>生成礼品卡</h5>
            </div>
            <div class="ibox-content main" ng-app='app'>
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                <a href="{{route('giftCardType.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 礼品卡类型管理</button></a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{ route('gifts.store') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">礼品卡类型：</label>
                        <div class="input-group col-sm-3">
                            {{$info->name}}
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始时间：</label>
                        <div class="input-group col-sm-2" ng-controller='controller'>
                            <input  class="form-control" size="18" type="text" name="start_time" id="start_time" value="{{date('Y-m-d H:i:s',$info->start_time)}}" readonly data-msg-required="请输入礼品卡开始时间"/>
                            @if ($errors->has('start_time'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('start_time')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">结束时间：</label>
                        <div class="input-group col-sm-2" ng-controller='controller'>
                            <input  class="form-control" size="18" type="text" name="end_time" id="end_time" value="{{date('Y-m-d H:i:s',$info->end_time)}}" readonly data-msg-required="请输入礼品卡结束时间"/>
                            @if ($errors->has('end_time'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('end_time')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">生成数量：</label>
                        <div class="input-group col-sm-1">
                            <input type="text" class="form-control" name="num" value="1" required data-msg-required="请输入礼品卡售价">
                            @if ($errors->has('num'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('num')}}</span>
                            @endif
                        </div>
                    </div>
                    {{--<div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">公司：</label>
                        <div class="input-group col-sm-1">
                            <select class="form-control" name="company_id">
                                @foreach($company as $k=>$item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>--}}
                    <input type="hidden" class="form-control" name="id" value="{{$info->id}}" >
                    @if ($errors->has('id'))
                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('id')}}</span>
                    @endif
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
    <script type="text/javascript">
        /*var maxdate = getNowFormatDate();
        function clearDefaultText (el,id)
        {
            var obj = el;
            if(typeof(el) == "string")
                obj = document.getElementByIdx_x(id);
            obj.value = "";
        }*/
        //时间插件js代码2018-04-19
        /*angular.module('app',[]).controller('controller',function($scope){
            $('#start_time').datetimepicker({
                lang:'ch',
                format:'Y-m-d H:00',
                maxDate:maxdate,
                onChangeDateTime:function(data,mon,dd){
                    $scope.$apply(function(){
                        $scope.selectTime=mon[0].value;
                    });
                },
            });
            $('#end_time').datetimepicker({
                lang:'ch',
                format:'Y-m-d H:00',
                // maxDate:maxdate,
                onChangeDateTime:function(data,mon,dd){
                    $scope.$apply(function(){
                        $scope.selectTime=mon[0].value;
                    });
                },
            });
        });*/
        //获取当前时间，格式YYYY-MM-DD
        /*function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = year + seperator1 + month + seperator1 + strDate;
            return currentdate;
        }*/
    </script>
@endsection