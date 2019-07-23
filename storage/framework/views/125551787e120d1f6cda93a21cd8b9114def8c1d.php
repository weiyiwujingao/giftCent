<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>修改套餐</h5>
        </div>
        <div class="ibox-content">
            <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
            <a href="<?php echo e(route('giftGroup.index')); ?>"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 套餐管理</button></a>
            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
            <form class="form-horizontal m-t-md" id="f1" action="<?php echo e(route('giftGroup.update',$groupInfo->id)); ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <?php echo e(method_field('PATCH')); ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">套餐名称：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="name" value="<?php echo e($groupInfo->name); ?>" required data-msg-required="请输入套餐名称">
                        <?php if($errors->has('name')): ?>
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i><?php echo e($errors->first('name')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">市场价：</label>
                    <div class="input-group col-sm-2">
                        <input type="text" class="form-control" name="price" value="<?php echo e($groupInfo->price); ?>" required data-msg-required="请输入市场价">
                        <?php if($errors->has('price')): ?>
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i><?php echo e($errors->first('price')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态：</label>
                    <div class="input-group col-sm-1">
                        <select class="form-control" name="status">
                            <option value="1" <?php if($groupInfo->status == 1): ?> selected="selected" <?php endif; ?>>正常</option>
                            <option value="2" <?php if($groupInfo->status == 2): ?> selected="selected" <?php endif; ?>>隐藏</option>
                        </select>
                        <?php if($errors->has('status')): ?>
                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i><?php echo e($errors->first('status')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="gs_ids" value="<?php echo e($groupInfo->gs_ids); ?>" >
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>