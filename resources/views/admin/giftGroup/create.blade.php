@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>添加套餐</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)"><i class="fa fa-external-link"></i> 返回</a>
                {{--<a href="{{route('giftGroup.index')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 套餐管理</button></a>--}}
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="{{ route('giftGroup.store') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">套餐名称：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="name" value="" required data-msg-required="请输入套餐名称">
                            @if ($errors->has('name'))
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">套餐价格：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="price" required data-msg-required="请输入售价">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="input-group col-sm-1">
                            <select class="form-control" name="status">
                                <option value="1"  selected="selected">正常</option>
                                <option value="2">隐藏</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品组合：</label>
                        <div class="input-group col-sm-6">
                            {{--{{$goodsInfo['name']}}--}}
                            <select class="form-control" id="c01-select" name="gs_ids[]" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品组合总价：</label>
                        <div class="input-group col-sm-3">
                            {{--{{$goodsInfo['price']}}--}}
                            ￥<span id="priceTotal">0.00</span>
                        </div>
                    </div>
                    {{--<input type="hidden" class="form-control" name="gs_ids" value="{{$goodsInfo['ids']}}" >--}}
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
    <link href="{{loadEdition('/js/select2/css/select2.min.css')}}" rel="stylesheet">
    <script src="{{loadEdition('/js/select2/js/select2.full.min.js')}}"></script>
    <script>
        var token = $('meta[name="csrf-token"]').attr('content'),
                $priceTotal = $('#priceTotal'),
                priceTotal = 0;
        $("#c01-select").select2({
            ajax: {
                url: "/admin/GiftGoods/search",
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
                    //return;
                    var itemList = [];
                    var arr = resData.data
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