
@extends('admin.layouts.layout')

@section('title', '首页')

@section('css')
  <link href="{{loadEdition('/admin/css/pxgridsicons.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
  {!! csrf_field() !!}
  <div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol userblue">
          <i class="fa fa-cart-plus"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count1">1</h1></a>
          <p>今日订单</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol commred">
          <i class="fa fa-send"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count2">56</h1></a>
          <p>未发货订单</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol articlegreen">
          <i class="fa fa-gamepad"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count3">16</h1></a>
          <p>商品数量</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol rsswet">
          <i class="icon-users"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count4">30</h1></a>
          <p>用户数量</p>
        </div>
      </section>
    </div>
  </div>
  <div class="row">
    <!-- 表单 -->
    {{--<div class="col-lg-6">--}}
      {{--<section class="panel">--}}
        {{--<header class="panel-heading bm0">--}}
          {{--<span><strong>最新发布内容</strong></span>--}}
          {{--<span class="tools pull-right">--}}
                                {{--<a class="icon-chevron-down" href="javascript:;"></a>--}}
                            {{--</span>--}}

        {{--</header>--}}
        {{--<div class="panel-body" id="panel-bodys" style="display: block;">--}}
          {{--<table class="table table-hover personal-task">--}}
            {{--<tbody>--}}

            {{--</tbody>--}}
          {{--</table>--}}
        {{--</div>--}}
      {{--</section>--}}
    {{--</div>--}}
    <!-- 表单 -->

    <!-- 版权信息 -->
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading bm0">
          <span><strong>团队及版权信息</strong></span>
          <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
        </header>
        <div class="panel-body" id="panel-bodys" style="display: block;">
          <table class="table table-hover personal-task">
            <tbody>
            <tr>
              <td><strong>当前版本</strong>：V1.0</td>
              <td><strong>文件上传最大值</strong>：{{ini_get('upload_max_filesize')}}</td>
              <td> <strong>操作系统</strong>：{{PHP_OS}}</td>
              <td> <strong>时区设置</strong>：{{date_default_timezone_get()}}</td>
              <td><strong>WEB服务器</strong>：{{php_sapi_name()}}</td>
              <td></td>
            </tr>
            <tr>
              <td><strong>PHP版本</strong>：{{PHP_VERSION}}</td>
              <td><strong>zlip支持</strong>：@if(function_exists('gzclose')) 是 @else 否 @endif </td>
              <td id="mysqlVersion"><strong>mysql版本</strong>：5.5.58</td>
              <td><strong>当前ip</strong>：{{$_SERVER['SERVER_ADDR']}}</td>
              <td><strong>安装日期</strong>：2018-12-25</td>
              <td></td>
            </tr>
            <tr>

              <td id="gdVersion"><strong>GD版本</strong>：GD2( PNG JPEG GIF )</td>
              <td><strong>Socket支持</strong>：@if(function_exists('fsockopen')) 是 @else 否 @endif</td>
              <td><strong>编码</strong>：UTF-8 </td>
              <td><strong>安全模式</strong>：@if(ini_get('safe_mode')) 是 @else 否 @endif </td>
              <td><strong>安全模式GID</strong>：@if(function_exists('safe_mode_gid')) 是 @else 否 @endif</td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 版权信息 -->
  </div>
  {{--<div class="row">--}}
    {{--<div class="col-sm-12">--}}
      {{--<div class="ibox-title">--}}
        {{--<h5>系统更新日志</h5>--}}
      {{--</div>--}}
      {{--<div class="ibox-content timeline">--}}

        {{--<div class="timeline-item">--}}
          {{--<div class="row">--}}
          {{--</div>--}}
        {{--</div>--}}

      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
@stop
@section('footer-js')
  <link href="{{loadEdition('/js/jedate/skin/jedate.css')}}" rel="stylesheet">
  <script src="{{loadEdition('/js/jedate/jedate.min.js')}}"></script>
  <script type="text/javascript">
      url = "{{ route('index.mainData') }}";

      function showExpre() {
          $.ajax({
              url: url,
              type: 'get',
              dataType:'json',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              async: false,//设置成同步
              success: function (res) {
                  if(res['status']==1){
                      $('#count1').html(res['data']['todayOrderNum']);
                      $('#count2').html(res['data']['preOrderNum']);
                      $('#count3').html(res['data']['goodNum']);
                      $('#count4').html(res['data']['userNum']);
                      $('#mysqlVersion').html('<strong>mysql版本</strong>：'+res['data']['mysqlVersion']);
                      $('#gdVersion').html('<strong>GD版本</strong>：'+res['data']['gd_info']);
                  }
              }
          });

      }
      $(function () {
          showExpre();
      });
  </script>
@endsection
