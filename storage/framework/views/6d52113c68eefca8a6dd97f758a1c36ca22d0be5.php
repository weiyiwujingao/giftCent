<?php $__env->startSection('content'); ?>
    <style>
        #picbx img{
            border: 1px solid #eee;
        }
    </style>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>添加商品</h5>
            </div>
            <div class="ibox-content">
                <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                <a href="<?php echo e(route('giftGoods.index')); ?>"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 商品管理</button></a>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form class="form-horizontal m-t-md" action="<?php echo e(route('giftGoods.store')); ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品名称：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="name" value="" required data-msg-required="请输入商品名称">
                            <?php if($errors->has('name')): ?>
                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i><?php echo e($errors->first('name')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品价格：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="price" required data-msg-required="请输入售价">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品类型：</label>
                        <div class="input-group col-sm-2">
                            <select class="form-control" name="cat_id">
                            <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php $__currentLoopData = $item->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cat->id); ?>">
                                            └&nbsp&nbsp<?php echo e($cat->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="input-group col-sm-1">
                            <select class="form-control" name="status">
                                <option value="1"  selected="selected">正常</option>
                                <option value="2">下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">图片：</label>
                        <div class="input-group col-sm-5">
                            <div><label class="btn btn-info" for="uploadipt">选择图片</label> (尺寸：宽600px,高480px)</div>
                            <div id="picbx" style="padding-top: 10px;"></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">详情介绍：</label>
                        <div class="input-group col-sm-8">
                            <textarea name="content" id="container"></textarea>
                        </div>
                    </div>
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
    <div id="uploadbx" style="display: none;">
        <form id="uploadfrm" enctype="multipart/form-data" method="post">
            <input type="file" id="uploadipt" name="file" onchange="ajaxSubmitForm();">
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <script src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="//unpkg.com/wangeditor/release/wangEditor.min.js"></script>
    <script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>
    <script>
        var ue = UE.getEditor('container');
        function ajaxSubmitForm() {
            var option = {
                url: '/admin/giftGoods/upload',
                type: 'POST',
                dataType: 'json',
                headers: {"X-CSRF-TOKEN": '<?php echo e(csrf_token()); ?>'},
                success: function (res) {
                    if (res.status == 1) {
                        var imgSrc = res.data;
                        $('#picbx').html('<img src="/' + imgSrc + '" style="max-height: 300px;"><input type="hidden" name="imgs" value="/' + imgSrc + '">');
                    } else {
                        layer.alert(res.message || '上传失败');
                    }
                },
                error: function () {
                    layer.alert("上传失败");
                }
            };
            $("#uploadfrm").ajaxSubmit(option);
            return false;
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>