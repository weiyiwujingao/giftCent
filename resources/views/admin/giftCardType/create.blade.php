@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>添加礼品卡类型</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)"><i class="fa fa-external-link"></i> 返回</a>
                {{--<a href="{{route('giftCardType.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-external-link"></i> 礼品卡类型管理</button></a>--}}
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{ route('giftCardType.store') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">名称：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="name" value="" required data-msg-required="请输入礼品卡类型名称">
                            @if ($errors->has('name'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">价值：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="price" required data-msg-required="请输入价值">
                            @if ($errors->has('price'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('price')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">所属公司：</label>
                        <div class="input-group col-sm-2">
                            <select class="form-control" name="company_id" required>
                                <option value="">-请选择-</option>
                                <?php foreach($typeInfo['company_list'] as $item):?>
                                <option value="{{$item['id']}}}">{{$item['name']}}</option>
                                <?php endforeach;?>
                            </select>
                            @if ($errors->has('company_id'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('company_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始时间：</label>
                        <div class="input-group col-sm-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="start_time" name="start_time" required placeholder="有效期开始时间" readonly>
                                <span class="input-group-btn">
                                    <button class="btn" type="button" disabled>00:00:00</button>
                                </span>
                            </div>
                            @if ($errors->has('start_time'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('start_time')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">结束时间：</label>
                        <div class="input-group col-sm-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="有效期结束时间" required readonly>
                                <span class="input-group-btn">
                                    <button class="btn" type="button" disabled>23:59:59</button>
                                </span>
                            </div>
                            @if ($errors->has('end_time'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('end_time')}}</span>
                            @endif
                        </div>
                    </div>
                    {{--<div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="input-group col-sm-1">
                            <select class="form-control" name="is_online">
                                <option value="1"  selected="selected">线下</option>
                                <option value="2">线上</option>
                            </select>
                            @if ($errors->has('is_online'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('is_online')}}</span>
                            @endif
                        </div>
                    </div>--}}
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">套餐组合：</label>
                        <div class="input-group col-sm-6">
                            {{--{{$typeInfo['name']}}--}}
                            {{--<input type="text" class="form-control" id="userSelect">--}}
                            <select class="form-control" id="c01-select" name="gr_ids[]" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">套餐组合总价：</label>
                        <div class="input-group col-sm-3">
                            {{--{{$typeInfo['price']}}--}}
                            ￥<span id="priceTotal">0.00</span>
                        </div>
                    </div>
                    {{--<input type="hidden" class="form-control" name="gr_ids" value="{{$typeInfo['ids']}}" >
                    @if ($errors->has('gr_ids'))
                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('gr_ids')}}</span>
                    @endif--}}
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
@section('footer-js')
    <link href="{{loadEdition('/js/jedate/skin/jedate.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <script src="{{loadEdition('/js/jedate/jedate.min.js')}}"></script>
    <script src="{{loadEdition('/js/select2/js/select2.full.min.js')}}"></script>
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
        var token = $('meta[name="csrf-token"]').attr('content'),
                $priceTotal = $('#priceTotal'),
                priceTotal = 0;
        $("#c01-select").select2({
            ajax: {
                url: "/admin/GiftGroup/search",
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                sync: 'true',
                contentType: 'application/x-www-form-urlencoded',
                delay: 250,
                data: function (params) {
                    return {
                        name: params.term,
                    };
                },
                processResults: function (resData) {
                    //console.log(resData);
                    var itemList = [];
                    var arr = resData.data.data
                    for (i in arr) {
                        itemList.push({
                            id: arr[i].id,
                            text: arr[i].name,
                            'price': arr[i].price
                        });
                    }
                    return {
                        results: itemList
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            placeholder: '请选择',
            language: "zh-CN",
            allowClear: true,
            minimumInputLength: 1,
            multiple: true,
            templateResult: function (repo) {
                if (repo.loading) return repo.text;
                var markup = '<div><p class="text-primary">' + repo.text + '(￥' + repo.price + ')</p></div>';
                return markup;
            },
            templateSelection: function (repo) {
                //console.log(repo);
                return repo.text + '(￥' + repo.price + ')';
            },
            select: function (res) {
                console.log(res);
            },
            unselect: function (res) {
                console.log(res);
            }
        }).on('select2:select', function (e) {
            var data = e.params.data;
            priceTotal += Number(data.price);
            $priceTotal.text(priceTotal.toFixed(2));
            //console.log(e);
        }).on('select2:unselect', function (e) {
            //console.log(e);
            var data = e.params.data;
            priceTotal -= Number(data.price);
            $priceTotal.text(priceTotal.toFixed(2));
        });
    </script>
@endsection