<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>礼品卡管理</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    <a href="<?php echo e(route('giftCardType.index')); ?>" link-url="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加礼品卡</a>
                </div>
                <div class="h-right">
                    <form method="get" action="<?php echo e(route('gifts.index')); ?>" name="form">
                        <label>
                            <input type="text" placeholder="卡号" class="form-control" name="card_sn" <?php if(isset($search['card_sn'])): ?>value="<?php echo e($search['card_sn']); ?>"<?php endif; ?>>
                        </label>

                        <label>
                            <input type="text" placeholder="有效期开始日期" id="start_time" autocomplete="off" class="form-control" name="start_time" <?php if(isset($search['start_time'])): ?>value="<?php echo e($search['start_time']); ?>"<?php endif; ?>>
                        </label>
                        <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                        <label style="display: inline-block;">
                            <input type="text" placeholder="有效期结束日期" id="end_time" autocomplete="off" class="form-control" name="end_time" <?php if(isset($search['end_time'])): ?>value="<?php echo e($search['end_time']); ?>"<?php endif; ?>>
                        </label>

                        <label>
                            <select class="form-control" name="status">
                                <option value="-1">-状态-</option>
                                <option value="0" <?php if(isset($search['status']) && $search['status'] == 0): ?> selected <?php endif; ?>>未使用</option>
                                <option value="1" <?php if(isset($search['status']) && $search['status'] == 1): ?> selected <?php endif; ?>>已使用</option>
                                <option value="2" <?php if(isset($search['status']) && $search['status'] == 2): ?> selected <?php endif; ?>>已过期</option>
                            </select>
                        </label>
                        <label>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索
                            </button>
                        </label>
                     </form>
                </div>

            </div>
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="text-center" width="10">ID</th>
                        <th>卡号</th>
                        <th>礼品卡类型</th>
                        <th>价值</th>
                        
                        <th>有效期</th>
                        <th>添加时间</th>
                        <th>关联订单</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->card_sn); ?></td>
                            <td><?php echo e($item->cardType->name); ?></td>
                            <td>￥<?php echo e($item->cardType->price); ?></td>
                            
                            <td><?php echo e(date('Y-m-d H:i:s',$item->start_time)); ?> ~ <?php echo e(date('Y-m-d H:i:s',$item->end_time)); ?></td>
                            <td><?php echo e($item->create_time); ?></td>
                            <td>
                                <?php if($item->status == 1 && isset($item->order)): ?>
                                    <a href="<?php echo e(route('order.index',['order_sn'=>$item->order->order_sn])); ?>"><?php echo e($item->order->order_sn); ?></a>
                                 <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($item->status == 0): ?>
                                    <span class="text-navy">未使用</span>
                                <?php elseif($item->status == 1): ?>
                                    <span class="text-danger">已使用</span>
                                <?php elseif($item->status == 2): ?>
                                    <span class="text-danger">已过期</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$gifts->count()): ?>
                        <tr>
                            <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
              <?php echo e($gifts->links()); ?>

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <link href="<?php echo e(loadEdition('/js/jedate/skin/jedate.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(loadEdition('/js/jedate/jedate.min.js')); ?>"></script>
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
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>