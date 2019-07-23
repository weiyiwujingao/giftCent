<?php $__env->startSection('content'); ?>
    <style>
        .goods-name img{ width: 80px; border: 1px solid #eee;cursor: pointer;}
    </style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>物流列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">

                <div class="h-right">
                    <form method="get" action="<?php echo e(route('express.index')); ?>" name="form">
                    <label>
                        <input type="text" placeholder="订单号" name="order_sn" class="form-control" <?php if(isset($search['order_sn'])): ?>value="<?php echo e($search['order_sn']); ?>"<?php endif; ?>>
                    </label>
                    <label>
                        <input type="text" placeholder="快递单号" name="ex_num" class="form-control" <?php if(isset($search['ex_num'])): ?>value="<?php echo e($search['ex_num']); ?>"<?php endif; ?>>
                    </label>
                    <label>
                        <input type="text" placeholder="添加开始日期" id="start_time" name="start_time" <?php if(isset($search['start_time'])): ?>value="<?php echo e($search['start_time']); ?>"<?php endif; ?> autocomplete="off" class="form-control">
                    </label>
                    <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                    <label style="display: inline-block;">
                        <input type="text" placeholder="添加结束日期" id="end_time" autocomplete="off" name="end_time" <?php if(isset($search['end_time'])): ?>value="<?php echo e($search['end_time']); ?>"<?php endif; ?> class="form-control" >
                    </label>
                    <label>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                    </label>
                    </form>
                </div>

            </div>
            <form method="post" action="<?php echo e(route('express.index')); ?>" name="form">
                <?php echo csrf_field(); ?>

                <table class="table table-striped table-bordered table-hover m-t-md">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>快递单号</th>
                        <th>快递公司</th>
                        <th>公司电话</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->order_sn); ?></td>
                            <td><?php echo e($item->ex_num); ?></td>
                            <td><?php echo e($item->exInfo->ex_name); ?></td>
                            <td><?php echo e($item->exInfo->ex_tel); ?></td>
                            <td><?php echo e($item->create_time); ?></td>
                            <td>
                                <div class="btn-group express-show" >
                                    <input type="hidden" class = "ex_cnt_content" value="<?php echo e($item->order_sn); ?>">
                                    <a> <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-car"></i> 物流跟踪</button> </a>
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
        expressUrl = "<?php echo e(route('express.expressDetail')); ?>";
        function showExpre(order_sn) {
            var load = layer.load();
            $.ajax({
                url: expressUrl,
                type: 'get',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {'order_sn': order_sn},
                async: true,
                success: function (res) {
                    content = '<div style="padding: 20px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">';
                    if (res['status'] == 1) {
                        for ($i = 0; $i < res['data']['list'].length; $i++) {
                            content += res['data']['list'][$i]['time'] + '<br>' + res['data']['list'][$i]['context'] + '<br><br>';
                        }
                        content += '</div>';
                        layer.open({
                            type: 1,
                            title: '发货物流信息详情：',
                            area: ['600px', '80%'],
                            content: content
                        });
                    } else {
                        layer.msg('暂无物流信息！');
                        /*layer.open({
                            type: 1,
                            title: '发货物流信息详情：',
                            content: '<div style="padding: 20px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;"></div>'
                        });*/
                    }
                },
                complete: function () {
                    layer.close(load);
                }
            });
        }
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
            $('.express-show').on('click', function () {
                order_sn = $(this).find('.ex_cnt_content').val();
                showExpre(order_sn);
            });
            $("#addGroup").click(function () {
                var actionUrl = "<?php echo e(route('giftGroup.create')); ?>";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的物流', function () {
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>