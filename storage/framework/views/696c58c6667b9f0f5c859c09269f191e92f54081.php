<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>商品类别列表</h5>
        </div>
        <div class="ibox-content">
            
            <a href="<?php echo e(route('giftGoodCats.create')); ?>" link-url="javascript:void(0)"><button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus-circle"></i> 添加商品类别</button></a>
            <form method="post" action="<?php echo e(route('giftGoodCats.index')); ?>" name="form">
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th>类别名称</th>
                        <th>类型</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            
                            <td><?php echo e($item->name); ?></td>
                            <td>
                                <?php if($item->parent_id == 0): ?>
                                    <span class="text-navy">一级分类</span>
                                <?php else: ?>
                                    <span class="text-danger">子类</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group oprate">
                                    <a href="<?php echo e(route('giftGoodCats.edit',$item->id)); ?>">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    <?php if($item->status == 2): ?>
                                            <a href="<?php echo e(route('giftGoodCats.status',['status'=>1,'id'=>$item->id])); ?>"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    <?php else: ?>
                                            <a href="<?php echo e(route('giftGoodCats.status',['status'=>2,'id'=>$item->id])); ?>"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('giftGoodCats.delete',$item->id)); ?>"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                </div>
                            </td>
                        </tr>
                        <?php if($item->parent_id == 0): ?>
                            <?php $__currentLoopData = $item->cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    
                                    <td><?php echo e($value->name); ?></td>
                                    <td>
                                        <span class="text-danger">子类</span>
                                    </td>
                                    <td>
                                        <div class="btn-group oprate">
                                            <a href="<?php echo e(route('giftGoodCats.edit',$value->id)); ?>">
                                                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                            </a>
                                            <?php if($value->status == 2): ?>
                                                <a href="<?php echo e(route('giftGoodCats.status',['status'=>1,'id'=>$value->id])); ?>"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('giftGoodCats.status',['status'=>2,'id'=>$value->id])); ?>"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('giftGoodCats.delete',$value->id)); ?>"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($cats->links()); ?>

            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>