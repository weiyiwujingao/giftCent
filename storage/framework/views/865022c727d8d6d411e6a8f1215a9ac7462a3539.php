<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>套餐列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    <a href="<?php echo e(route('giftGroup.create')); ?>"  class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加套餐</a>
                    
                </div>
                <div class="h-right">
                    <form method="get" action="<?php echo e(route('giftGroup.index')); ?>" name="form">
                    <label>
                        <input type="text" placeholder="套餐名称" class="form-control" name="name" <?php if(isset($search['name'])): ?>value="<?php echo e($search['name']); ?>"<?php endif; ?>>
                    </label>
                    <label>
                        <input type="text" placeholder="添加开始日期" id="start_time" autocomplete="off" class="form-control" name="start_time" <?php if(isset($search['start_time'])): ?>value="<?php echo e($search['start_time']); ?>"<?php endif; ?>>
                    </label>
                    <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                    <label style="display: inline-block;">
                        <input type="text" placeholder="添加结束日期" id="end_time" autocomplete="off" class="form-control" name="end_time" <?php if(isset($search['end_time'])): ?>value="<?php echo e($search['end_time']); ?>"<?php endif; ?>>
                    </label>

                    <label>
                        <select class="form-control" name="status">
                            <option value="-1" <?php if(isset($search['status']) && $search['status'] == '-1'): ?> selected <?php endif; ?>>-状态-</option>
                            <option value="1" <?php if(isset($search['status']) && $search['status'] == '1'): ?> selected <?php endif; ?>>正常</option>
                            <option value="2" <?php if(isset($search['status']) && $search['status'] == '2'): ?> selected <?php endif; ?> >隐藏</option>
                        </select>
                    </label>
                    <label>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                    </label>
                    </form>
                </div>
            </div>
            <form method="post" action="<?php echo e(route('giftGroup.index')); ?>" name="form">
                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th class="bs-checkbox " style="width: 36px; " data-field="state" tabindex="0">
                                <input type="checkbox" name="all_list" class="checkbox" id="all_list">
                        </th>
                        <th class="text-center" width="10">ID</th>
                        <th>套餐名称</th>
                        <th>市场价</th>
                        <th>商品组合</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="bs-checkbox"><input type="checkbox" name="checkboxes[]" value="<?php echo e($item->id); ?>" class="checkbox"></td>
                            <td class="text-center"><?php echo e($item->id); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td>￥<?php echo e($item->price); ?></td>
                            <td><a href="#" class="view-page" data-link="<?php echo e(route('giftGoods.index',['gs_ids'=>$item->gs_ids])); ?>"><?php echo e($item->goodlist); ?></a></td>
                            <td><?php echo e($item->create_time); ?></td>
                            <td>
                                <?php if($item->status == 1): ?>
                                    <span class="text-navy">正常</span>
                                <?php elseif($item->status == 2): ?>
                                    <span class="text-danger">下架</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('giftGroup.edit',$item->id)); ?>">
                                        <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                                    </a>
                                    <?php if($item->status == 2): ?>
                                            <a href="<?php echo e(route('giftGroup.status',['status'=>1,'id'=>$item->id])); ?>"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 显示</button></a>
                                    <?php else: ?>
                                            <a href="<?php echo e(route('giftGroup.status',['status'=>2,'id'=>$item->id])); ?>"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 隐藏</button></a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('giftGroup.delete',$item->id)); ?>"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$groups->count()): ?>
                        <tr>
                            <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($groups->links()); ?>

            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <link href="<?php echo e(loadEdition('/js/jedate/skin/jedate.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(loadEdition('/js/jedate/jedate.min.js')); ?>"></script>
    <script type="text/javascript">
        //全选切换效果
        $(document).on("click", "input[name='all_list']", function () {
            if ($(this).prop("checked") == true) {
                $("td").find("input[type='checkbox']").prop("checked", true);
            } else {
                $("td").find("input[type='checkbox']").prop("checked", false);
            }
        });
        function execUser() {
            var ids = '';
            $("td").find("input[name='checkboxes[]']:checked").each(function (i) {
                var id = $(this).val();
                ids += id + ',';
            });
            return ids;
        }
        $(function () {
            /*$("#addGift").click(function () {
                var actionUrl = "<?php echo e(route('giftCardType.create')); ?>";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的套餐', function () {
                        return false;
                    });
                    return false;
                }
                window.location.href = actionUrl + '?ids=' + ids;
            });*/
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
            $('.view-page').on('click', function (e) {
                e.preventDefault();
                var link = $(this).data('link');
                var _title = $.trim($(this).text());
                layer.open({
                    type: 2,
                    title: _title,
                    shadeClose: true,
                    shade: 0.8,
                    area: ['80%', '90%'],
                    content: link
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>