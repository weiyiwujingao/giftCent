<?php $__env->startSection('content'); ?>
    <style>
        .fa-check{
            color: green;
        }
        .fa-close{
            color: red;
        }
    </style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>礼品卡类型列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    
                    <a href="<?php echo e(route('giftCardType.create')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加礼品卡类型</a>
                </div>
                <div class="h-right">
                    <form method="get" action="<?php echo e(route('giftCardType.index')); ?>" name="form">
                        <label>
                            <input type="text" placeholder="名称" class="form-control" name="name" <?php if(isset($search['name'])): ?>value="<?php echo e($search['name']); ?>"<?php endif; ?>>
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
                                <option value="1" <?php if(isset($search['status']) && $search['status'] == '1'): ?> selected <?php endif; ?> >正常使用</option>
                                <option value="0" <?php if(isset($search['status']) && $search['status'] == '0'): ?> selected <?php endif; ?>>不可使用</option>
                            </select>
                        </label>
                        <label>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                        </label>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover m-t-md">
                <thead>
                <tr>
                    <th class="text-center" width="10">ID</th>
                    <th>名称</th>
                    <th>套餐组合</th>
                    <th>价值</th>
                    <th>所属公司</th>
                    <th>有效期</th>
                    <th>卡数量</th>
                    <th>已使用卡数量</th>
                    <th>添加时间</th>
                    <th>状态</th>
                    
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($item->id); ?></td>
                        <td><?php echo e($item->name); ?></td>
                        <td><a href="#" class="view-page" data-link="<?php echo e(route('giftGroup.index',['gr_ids'=>$item->gr_ids])); ?>"><?php echo e($item->grouplist); ?></a></td>
                        <td><?php echo e($item->price); ?></td>
                        <td><?php echo e($item->company->name); ?></td>
                        <td><?php echo e(date('Y-m-d H:i:s',$item->start_time)); ?> ~ <?php echo e(date('Y-m-d H:i:s',$item->end_time)); ?></td>
                        <td><a href="#" class="view-page" data-link="<?php echo e(route('gifts.index',['cty_id'=>$item->id])); ?>"><?php echo e($item->card_count); ?></a></td>
                        <td><a href="#" class="view-page" data-link="<?php echo e(route('gifts.index',['cty_id'=>$item->id,'status'=>1])); ?>"><?php echo e($item->use_count); ?></a></td>
                        <td><?php echo e($item->create_time); ?></td>
                        <td align="center">
                            <?php if($item->status == 1): ?>
                                <i class="fa fa-check" title="正常使用"></i>
                            <?php else: ?>
                                <i class="fa fa-close" title="不可使用"></i>
                            <?php endif; ?>
                        </td>
                        </td>
                        
                        <td class="oprate">
                            <div class="btn-group">
                                <a href="<?php echo e(route('giftCardType.edit',$item->id)); ?>">
                                    <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-edit"></i> 修改</button>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?php echo e(route('gifts.create',['id'=>$item->id])); ?>">
                                    <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 发放</button>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="<?php echo e(route('giftCardType.explodeData')); ?>?id=<?php echo e($item->id); ?>">
                                    <button class="btn btn-success btn-xs" type="button"><i class="fa fa-file-excel-o"></i> 导出</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$list->count()): ?>
                    <tr>
                        <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($list->links()); ?>

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <link href="<?php echo e(loadEdition('/js/jedate/skin/jedate.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(loadEdition('/js/jedate/jedate.min.js')); ?>"></script>
    <script>
        //全选切换效果
        $(document).on("click","input[name='all_list']",function(){
            if($(this).prop("checked") == true){
                $("td").find("input[type='checkbox']").prop("checked",true);
            }else{
                $("td").find("input[type='checkbox']").prop("checked",false);
            }
        });
        function execUser() {
            var ids = '';
            $("td").find("input[name='checkboxes[]']:checked").each(function(i){
                var id = $(this).val();
                ids += id + ',';
            });
            return ids;
        }
        $(function () {
            $("#addGift").click(function () {
                var actionUrl = "<?php echo e(route('giftGroup.create')); ?>";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的商品', function () {
                        return false;
                    });
                    return false;
                }
                window.location.href = actionUrl + '?ids=' + ids;
            });

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