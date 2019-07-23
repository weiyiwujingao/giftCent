<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>公司列表</h5>
        </div>
        <div class="ibox-content">
            
            <a href="<?php echo e(route('giftCompany.create')); ?>" link-url="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加公司</a>
            <form method="post" action="<?php echo e(route('giftCompany.index')); ?>" name="form">
                <?php echo csrf_field(); ?>

                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="text-center" width="10">ID</th>
                        <th>名称</th>
                        <th>英文名</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $companyList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->en_name); ?></td>
                            <td><?php echo e($item->create_time); ?></td>
                            <td>
                                <?php if($item->status == 1): ?>
                                    <span class="text-navy">正常</span>
                                <?php elseif($item->status == 2): ?>
                                    <span class="text-danger">删除</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('giftCompany.edit',$item->id)); ?>">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    <?php if($item->status == 2): ?>
                                            <a href="<?php echo e(route('giftCompany.status',['status'=>1,'id'=>$item->id])); ?>"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    <?php else: ?>
                                            <a href="<?php echo e(route('giftCompany.status',['status'=>2,'id'=>$item->id])); ?>"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 删除</button></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($companyList->links()); ?>

            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>