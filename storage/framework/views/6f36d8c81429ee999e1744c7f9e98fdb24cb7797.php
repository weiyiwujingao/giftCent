<?php $__env->startSection('content'); ?>
    <style>
        .goods-name img{ width: 80px; border: 1px solid #eee;cursor: pointer;}
    </style>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox-title">
            <h5>商品列表</h5>
        </div>
        <div class="ibox-content">
            <div class="head-bx">
                <div class="h-left">
                    <a href="<?php echo e(route('giftGoods.create')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> 添加商品</a>
                   
                </div>
                <div class="h-right">
                    <form method="get" action="<?php echo e(route('giftGoods.index')); ?>" name="form">
                        <label>
                            <input type="text" placeholder="商品名称" name="name" class="form-control" <?php if(isset($search['name'])): ?>value="<?php echo e($search['name']); ?>"<?php endif; ?>>
                        </label>
                        <label>
                            <input type="text" placeholder="添加开始日期" id="start_time" name="start_time" <?php if(isset($search['start_time'])): ?>value="<?php echo e($search['start_time']); ?>"<?php endif; ?> autocomplete="off" class="form-control">
                        </label>
                        <span style="width: 20px;font-size: 14px;text-align: center;color: #999;display: inline-block">至</span>
                        <label style="display: inline-block;">
                            <input type="text" placeholder="添加结束日期" id="end_time" autocomplete="off" name="end_time" <?php if(isset($search['end_time'])): ?>value="<?php echo e($search['end_time']); ?>"<?php endif; ?> class="form-control" >
                        </label>

                        <label>
                            <select class="form-control" name="status">
                                <option value="-1" <?php if(isset($search['status']) && $search['status'] == '-1'): ?> selected <?php endif; ?> >-状态-</option>
                                <option value="1" <?php if(isset($search['status']) && $search['status'] == 1): ?> selected <?php endif; ?> >正常</option>
                                <option value="2" <?php if(isset($search['status']) && $search['status']== 2): ?> selected <?php endif; ?> >下架</option>
                            </select>
                        </label>
                        <label>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 搜索</button>
                        </label>
                    </form>
                </div>
            </div>
            <?php echo csrf_field(); ?>

            <table class="table table-striped table-bordered table-hover m-t-md">
                <thead>
                <tr>
                    <th class="bs-checkbox " style="width: 36px; " data-field="state" tabindex="0">
                            <input type="checkbox" name="all_list" class="checkbox" id="all_list">
                    </th>
                    <th class="text-center" width="10">ID</th>
                    <th>商品名称</th>
                    <th>售价</th>
                    <th>类型</th>
                    <th>添加时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="bs-checkbox"><input type="checkbox" name="checkboxes[]" value="<?php echo e($item->id); ?>" class="checkbox"></td>
                        <td class="text-center"><?php echo e($item->id); ?></td>
                        <td class="goods-name"> <?php if($item->imgs): ?> <img src="<?php echo e($item->imgs); ?>" class="pro-img" alt="<?php echo e($item->name); ?>"> <?php endif; ?> <?php echo e($item->name); ?></td>
                        <td>￥<?php echo e($item->price); ?></td>
                        <td>
                            <?php echo e($item->cats->name); ?>

                        </td>
                        <td><?php echo e($item->create_time); ?></td>
                        <td>
                            <?php if($item->status == 1): ?>
                                <span class="text-navy">正常</span>
                            <?php elseif($item->status == 2): ?>
                                <span class="text-danger">下架</span>
                            <?php endif; ?>
                        </td>
                        <td class="oprate">
                            <a href="<?php echo e(route('giftGoods.edit',$item->id)); ?>">
                                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i> 修改</button>
                            </a>
                            <?php if($item->status == 2): ?>
                                <a href="<?php echo e(route('giftGoods.status',['status'=>1,'id'=>$item->id])); ?>"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-warning"></i> 上架</button></a>
                            <?php else: ?>
                                <a href="<?php echo e(route('giftGoods.status',['status'=>2,'id'=>$item->id])); ?>"><button class="btn btn-warning btn-xs" type="button"><i class="fa fa-warning"></i> 下架</button></a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('giftGoods.delete',$item->id)); ?>"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> 删除</button></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$goods->count()): ?>
                    <tr>
                        <td colspan="10" class="text-center" style="color: #999;">没有符合条件的数据</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($goods->links()); ?>

        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-js'); ?>
    <link href="<?php echo e(loadEdition('/js/jedate/skin/jedate.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(loadEdition('/js/jedate/jedate.min.js')); ?>"></script>
    <script type="text/javascript">
        function showImg(src, name) {
            var json = {
                "title": "图片浏览", //相册标题
                "id": 1, //相册id
                "start": 0, //初始显示的图片序号，默认0
                "data": [   //相册包含的图片，数组格式
                    {
                        "alt": name,
                        "pid": 1, //图片id
                        "src": src, //原图地址
                        "thumb": src //缩略图地址
                    }
                ]
            };
            layer.photos({
                photos: json
                , anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
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
            $('img.pro-img').on('click', function () {
                var src = $(this).attr('src');
                var name = $(this).attr('alt');
                showImg(src, name);
            });
            /*$("#addGroup").click(function () {
                var actionUrl = "<?php echo e(route('giftGroup.create')); ?>";
                var ids = execUser();
                if (ids == '') {
                    layer.msg('请选择勾选要组合的商品', function () {
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>