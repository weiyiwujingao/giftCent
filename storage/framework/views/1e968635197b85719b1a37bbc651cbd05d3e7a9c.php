<?php $__env->startSection('title', '首页'); ?>

<?php $__env->startSection('css'); ?>
  <link href="<?php echo e(loadEdition('/admin/css/pxgridsicons.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php echo csrf_field(); ?>

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
              <td><strong>文件上传最大值</strong>：<?php echo e(ini_get('upload_max_filesize')); ?></td>
              <td> <strong>操作系统</strong>：<?php echo e(PHP_OS); ?></td>
              <td> <strong>时区设置</strong>：<?php echo e(date_default_timezone_get()); ?></td>
              <td><strong>WEB服务器</strong>：<?php echo e(php_sapi_name()); ?></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>PHP版本</strong>：<?php echo e(PHP_VERSION); ?></td>
              <td><strong>zlip支持</strong>：<?php if(function_exists('gzclose')): ?> 是 <?php else: ?> 否 <?php endif; ?> </td>
              <td id="mysqlVersion"><strong>mysql版本</strong>：5.5.58</td>
              <td><strong>当前ip</strong>：<?php echo e($_SERVER['SERVER_ADDR']); ?></td>
              <td><strong>安装日期</strong>：2018-12-25</td>
              <td></td>
            </tr>
            <tr>

              <td id="gdVersion"><strong>GD版本</strong>：GD2( PNG JPEG GIF )</td>
              <td><strong>Socket支持</strong>：<?php if(function_exists('fsockopen')): ?> 是 <?php else: ?> 否 <?php endif; ?></td>
              <td><strong>编码</strong>：UTF-8 </td>
              <td><strong>安全模式</strong>：<?php if(ini_get('safe_mode')): ?> 是 <?php else: ?> 否 <?php endif; ?> </td>
              <td><strong>安全模式GID</strong>：<?php if(function_exists('safe_mode_gid')): ?> 是 <?php else: ?> 否 <?php endif; ?></td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 版权信息 -->
  </div>
  
    
      
        
      
      

        
          
          
        

      
    
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
  <link href="<?php echo e(loadEdition('/js/jedate/skin/jedate.css')); ?>" rel="stylesheet">
  <script src="<?php echo e(loadEdition('/js/jedate/jedate.min.js')); ?>"></script>
  <script type="text/javascript">
      url = "<?php echo e(route('index.mainData')); ?>";

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>