<?php

namespace Enum;
use Illuminate\Support\Facades\Cache;
final class EnumLang {
    //首页配置专用枚举
    public static $LANG = [
        'shop_guide' => '开店向导',
        'set_navigator' => '设置导航栏',
        'about' => '关于 ECSHOP',
        'preview' => '查看网店',
        'menu' => '菜单',
        'help' => '帮助',
        'signout' => '退出',
        'profile' => '个人设置',
        'view_message' => '管理员留言',
        'send_msg' => '发送留言',
        'toggle_calculator' => '计算器',
        'expand_all' => '展开',
        'collapse_all' => '闭合',
        'no_help' => '暂时还没有该部分内容',
        'license_free' => '非授权用户',
        'license_commercial' => '绿卡用户',
        'license_invalid' => '未授权用户',
        'license_failed' => '非法用户',
        'license_oem' => '授权商业用户',
        'license_oemtest' => '体验用户',

        'license_Q' => '商业',
        'license_G' => '商业',
        'license_L' => '临时',
        'license_S' => '商业',
        'license_O' => '企业',
        'license_T' => '体验',
        'license_no' => '免费',
        'license_test' => '免费',


        /*------------------------------------------------------ */
        //-- 计算器
        /*------------------------------------------------------ */

        'calculator' => '计算器',
        'clear_calculator' => '清除',
        'backspace' => '退格',

        /*------------------------------------------------------ */
        //-- 起始页
        /*------------------------------------------------------ */
        'pm_title' => '留言标题',
        'pm_username' => '留言者',
        'pm_time' => '留言时间',

        'order_stat' => '订单统计信息',
        'unconfirmed' => '未确认订单:',
        'await_ship' => '待发货订单:',
        'await_pay' => '待支付订单:',
        'finished' => '已成交订单数:',
        'new_booking' => '新缺货登记:',
        'new_reimburse' => '退款申请:',
        'shipped_part' => '部分发货订单:',

        'goods_stat' => '实体商品统计信息',
        'virtual_card_stat' => '虚拟卡商品统计',
        'goods_count' => '商品总数:',
        'sales_count' => '促销商品数:',
        'new_goods' => '新品推荐数:',
        'recommed_goods' => '精品推荐数:',
        'hot_goods' => '热销商品数:',
        'warn_goods' => '库存警告商品数:',
        'clear_cache' => '清除缓存',
        'ebao_commend' => '易宝推荐',

        'acess_stat' => '访问统计',
        'acess_today' => '今日访问:',
        'online_users' => '在线人数:',
        'user_count' => '会员总数:',
        'today_register' => '今日注册:',
        'new_feedback' => '最新留言:',
        'new_comments' => '未审核评论:',

        'system_info' => '系统信息',
        'web_server' => 'Web 服务器:',
        'php_version' => 'PHP 版本:',
        'mysql_version' => 'MySQL 版本:',
        'gd_version' => 'GD 版本:',
        'zlib' => 'Zlib 支持:',
        'ecs_version' => 'ECShop 版本:',
        'install_date' => '安装日期:',
        'ip_version' => 'IP 库版本:',
        'max_filesize' => '文件上传的最大大小:',
        'safe_mode' => '安全模式:',
        'safe_mode_gid' => '安全模式GID:',
        'timezone' => '时区设置:',
        'no_timezone' => '无需设置',
        'socket' => 'Socket 支持:',
        'ec_charset' => '编码:',

        'remove_install' => '您还没有删除 install 文件夹，出于安全的考虑，我们建议您删除 install 文件夹。',
        'remove_upgrade' => '您还没有删除 upgrade 文件夹，出于安全的考虑，我们建议您删除 upgrade 文件夹。',
        'remove_demo' => '您还没有删除 demo 文件夹，出于安全的考虑，我们建议您删除 demo 文件夹。',
        'temp_dir_cannt_read' => '您的服务器设置了 open_base_dir 且没有包含 %s，您将无法上传文件。',
        'not_writable' => '%s 目录不可写入，%s',
        'data_cannt_write' => '您将无法上传包装、贺卡、品牌等等图片文件。',
        'afficheimg_cannt_write' => '您将无法上传广告的图片文件。',
        'brandlogo_cannt_write' => '您将无法上传品牌的图片文件。',
        'cardimg_cannt_write' => '您将无法上传贺卡的图片文件。',
        'feedbackimg_cannt_write' => '用户将无法通过留言上传文件。',
        'packimg_cannt_write' => '您将无法上传包装的图片文件。',
        'cert_cannt_write' => '您将无法上传 ICP 备案证书文件。',
        'images_cannt_write'=> '您将无法上传任何商品图片。',
        'imagesupload_cannt_write'=> '您将无法通过编辑器上传任何图片。',
        'tpl_cannt_write' => '您的网站将无法浏览。',
        'tpl_backup_cannt_write' => '您就无法备份当前的模版文件。',
        'order_print_canntwrite' => 'data目录下的order_print.html文件属性为不可写，您将无法修改订单打印模板。',
        'shop_closed_tips' => '您的商店已被暂时关闭。在设置好您的商店之后别忘记打开哦！',
        'empty_upload_tmp_dir' => '当前的上传临时目录为空，您可能无法上传文件，请检查 php.ini 中的设置。',
        'caches_cleared' => '页面缓存已经清除成功。',

        /*------------------------------------------------------ */
            //-- 关于我们
        /*------------------------------------------------------ */
        'team_member' => 'ECSHOP 团队成员',
        'before_team_member' => 'ECSHOP 贡献者',

        'director' => '项目策划',
        'programmer' => '程序开发',
        'ui_designer' => '界面设计',
        'documentation' => '文档整理',
        'special_thanks' => '特别感谢',
        'official_site' => '官方网站',
        'site_url' => '网站地址:',
        'support_center' => '支持中心:',
        'support_forum' => '支持论坛:',
        // 邮件群发
        'mailsend_fail' => '邮件 %s 发送失败!',
        'mailsend_ok' => '邮件 %s 发送成功!还有 %s 邮件未发送!',
        'mailsend_finished' => '邮件 %s 发送成功!全部邮件发送完成!',
        'mailsend_null' => '邮件发送列表空!',
        'mailsend_skip' => '继续发送下一条...',
        'email_sending' => '正在处理邮件发送队列...',
        'pause' => '暂停',
        'conti' => '继续',
        'str' => '已经发送了 %d 封邮件。',

        //开店向导
        'shop_name' => '商店名称',
        'shop_title' => '商店标题',
        'shop_country' => '所在国家',
        'shop_province' => '所在省份',
        'shop_city' => '所在城市',
        'shop_address' => '详细地址',
        'shop_ship' => '配送方式',
        'ship_name' => '配送区域名称',
        'ship_country' => '国家',
        'ship_province' => '省份',
        'ship_city' => '城市',
        'ship_district' => '县/区',
        'shop_pay' => '支付方式',
        'select_please' => '请选择...',
        'good_name' => '商品名称',
        'good_number' => '商品数量',
        'good_category' => '商品分类',
        'good_brand' => '商品品牌',
        'good_price' => '商品价格',
        'good_brief' => '商品描述',
        'good_image' => '上传商品图片',
        'is_new' => '新品',
        'is_best' => '精品',
        'is_hot' => '热卖',
        'good_intro' => '加入推荐',
        'skip' => '完成向导',
        'next_step' => '下一步',
        'ur_add' => '开店向导－添加商品',
        'ur_config' => '开店向导－设置网店',
        'shop_basic_first' => "设置商店的一些基本信息<em>商店的名字、地址、配送方式、支付方式等</em>",
        'shop_basic_second' => "给商店添加一些商品<em>商品的名称、数量、分类、品牌、价格、描述等</em>",
        'shop_basic_third' => "恭喜您，您的网店可以使用了！<em>下面是一些常用功能的链接聚合。您关闭本页后，依然可以在左侧菜单相关项目中找到</em>",
        'add_good' => '添加商品',
        'add_category' => '添加商品分类',
        'add_type' => '商品类型',
        'add_favourable' => '添加优惠活动',
        'shop_config' => '商店设置',
        'select_template' => '选择模板',
        'shop_back_in' => '进入网店后台',
        'goods_img_too_big' => '商品图片文件太大了（最大值:%s），无法上传。',
        'invalid_goods_img' => '商品图片格式不正确！',

        /*后台语言项*/
        'send_mail_off' => '自动发送邮件关闭',
        //JS语言
        'js_languages'=>['expand_all' => '展开'],
        'js_languages'=>['collapse_all'=> '闭合'],
        'js_languages'=>['shop_name_not_null'=> '商店名称不能为空'],
        'js_languages'=>['good_name_not_null'=> '商品名称不能为空'],
        'js_languages'=>['good_category_not_null' => '商品分类不能为空'],
        'js_languages'=>['good_number_not_number' => '商品数量不是数值'],
        'js_languages'=>['good_price_not_number' => '商品价格不是数值'],

        /* 订单搜索 */
        'order_sn'=> '订单号',
        'consignee'=> '收货人',
        'all_status'=> '订单状态',

        'cs'=>[\Enum\EnumKeys::OS_UNCONFIRMED=> '待确认'],
        'cs'=>[\Enum\EnumKeys::CS_AWAIT_PAY=> '待付款'],
        'cs'=>[\Enum\EnumKeys::CS_AWAIT_SHIP=> '待发货'],
        'cs'=>[\Enum\EnumKeys::CS_FINISHED=> '已完成'],
        'cs'=>[\Enum\EnumKeys::PS_PAYING=> '付款中'],
        'cs'=>[\Enum\EnumKeys::OS_CANCELED=> '取消'],
        'cs'=>[\Enum\EnumKeys::OS_INVALID=> '无效'],
        'cs'=>[\Enum\EnumKeys::OS_RETURNED=> '退货'],
        'cs'=>[\Enum\EnumKeys::OS_SHIPPED_PART=> '部分发货'],

        /* 订单状态 */
        'os'=>[
            \Enum\EnumKeys::OS_UNCONFIRMED=> '未确认',
            \Enum\EnumKeys::OS_CONFIRMED=> '已确认',
            \Enum\EnumKeys::OS_CANCELED=> '<font color="red"> 取消</font>',
            \Enum\EnumKeys::OS_INVALID=> '<font color="red">无效</font>',
            \Enum\EnumKeys::OS_RETURNED=> '<font color="red">退货</font>',
            \Enum\EnumKeys::OS_SPLITED=> '已分单',
            \Enum\EnumKeys::OS_SPLITING_PART=> '部分分单',
            ],
        'ss'=>[
            \Enum\EnumKeys::SS_UNSHIPPED=> '未发货',
            \Enum\EnumKeys::SS_PREPARING=> '配货中',
            \Enum\EnumKeys::SS_SHIPPED=> '已发货',
            \Enum\EnumKeys::SS_RECEIVED=> '收货确认',
            \Enum\EnumKeys::SS_SHIPPED_PART=> '已发货(部分商品)',
            \Enum\EnumKeys::SS_SHIPPED_ING=> '发货中',
        ],
        'ps'=>[
            \Enum\EnumKeys::PS_UNPAYED=> '未付款',
            \Enum\EnumKeys::PS_PAYING=> '付款中',
            \Enum\EnumKeys::PS_PAYED=> '已付款',
        ],
        'ss_admin'=>[\Enum\EnumKeys::SS_SHIPPED_ING=> '发货中（前台状态：未发货）'],
        /* 订单操作 */
        'label_operable_act'=> '当前可执行操作：',
        'label_action_note'=> '操作备注：',
        'label_invoice_note'=> '发货备注：',
        'label_invoice_no'=> '发货单号：',
        'label_cancel_note'=> '取消原因：',
        'notice_cancel_note'=> '（会记录在商家给客户的留言中）',
        'op_confirm'=> '确认',
        'op_pay'=> '付款',
        'op_prepare'=> '配货',
        'op_ship'=> '发货',
        'op_cancel'=> '取消',
        'op_invalid'=> '无效',
        'op_return'=> '退货',
        'op_unpay'=> '设为未付款',
        'op_unship'=> '未发货',
        'op_cancel_ship'=> '取消发货',
        'op_receive'=> '已收货',
        'op_assign'=> '指派给',
        'op_after_service'=> '售后',
        'act_ok'=> '操作成功',
        'act_false'=> '操作失败',
        'act_ship_num'=> '此单发货数量不能超出订单商品数量',
        'act_good_vacancy'=> '商品已缺货',
        'act_good_delivery'=> '货已发完',
        'notice_gb_ship'=> '备注：团购活动未处理为成功前，不能发货',
        'back_list'=> '返回订单列表',
        'op_remove'=> '删除',
        'op_you_can'=> '您可进行的操作',
        'op_split'=> '生成发货单',
        'op_to_delivery'=> '去发货',

        /* 订单列表 */
        'order_amount'=> '应付金额',
        'total_fee'=> '总金额',
        'shipping_name'=> '配送方式',
        'pay_name'=> '支付方式',
        'address'=> '地址',
        'order_time'=> '下单时间',
        'detail'=> '查看',
        'phone'=> '电话',
        'group_buy'=> '（团购）',
        'error_get_goods_info'=> '获取订单商品信息错误',
        'exchange_goods'=> '（积分兑换）',

        'js_languages'=>['remove_confirm'=> '删除订单将清除该订单的所有信息。您确定要这么做吗？'],

        /* 订单搜索 */
        'label_order_sn'=> '订单号：',
        'label_all_status'=> '订单状态：',
        'label_user_name'=> '购货人：',
        'label_consignee'=> '收货人：',
        'label_email'=> '电子邮件：',
        'label_address'=> '地址：',
        'label_zipcode'=> '邮编：',
        'label_tel'=> '电话：',
        'label_mobile'=> '手机：',
        'label_shipping'=> '配送方式：',
        'label_payment'=> '支付方式：',
        'label_order_status'=> '订单状态：',
        'label_pay_status'=> '付款状态：',
        'label_shipping_status'=> '发货状态：',
        'label_area'=> '所在地区：',
        'label_time'=> '下单时间：',

        /* 订单详情 */
        'prev'=> '前一个订单',
        'next'=> '后一个订单',
        'print_order'=> '打印订单',
        'print_shipping'=> '打印快递单',
        'print_order_sn'=> '订单编号：',
        'print_buy_name'=> '购 货 人：',
        'label_consignee_address'=> '收货地址：',
        'no_print_shipping'=> '很抱歉,目前您还没有设置打印快递单模板.不能进行打印',
        'suppliers_no'=> '不指定供货商本店自行处理',
        'restaurant'=> '本店',

        'order_info'=> '订单信息',
        'base_info'=> '基本信息',
        'other_info'=> '其他信息',
        'consignee_info'=> '收货人信息',
        'fee_info'=> '费用信息',
        'action_info'=> '操作信息',
        'shipping_info'=> '配送信息',

        'label_how_oos'=> '缺货处理：',
        'label_how_surplus'=> '余额处理：',
        'label_pack'=> '包装：',
        'label_card'=> '贺卡：',
        'label_card_message'=> '贺卡祝福语：',
        'label_order_time'=> '下单时间：',
        'label_pay_time'=> '付款时间：',
        'label_shipping_time'=> '发货时间：',
        'label_sign_building'=> '标志性建筑：',
        'label_best_time'=> '最佳送货时间：',
        'label_inv_type'=> '发票类型：',
        'label_inv_payee'=> '发票抬头：',
        'label_inv_content'=> '发票内容：',
        'label_postscript'=> '客户给商家的留言：',
        'label_region'=> '所在地区：',

        'label_shop_url'=> '网址：',
        'label_shop_address'=> '地址：',
        'label_service_phone'=> '电话：',
        'label_print_time'=> '打印时间：',

        'label_suppliers'=> '选择供货商：',
        'label_agency'=> '办事处：',
        'suppliers_name'=> '供货商',

        'product_sn'=> '货品号',
        'goods_info'=> '商品信息',
        'goods_name'=> '商品名称',
        'goods_name_brand'=> '商品名称 [ 品牌 ]',
        'goods_sn'=> '货号',
        'goods_price'=> '价格',
        'goods_number'=> '数量',
        'goods_attr'=> '属性',
        'goods_delivery'=> '已发货数量',
        'goods_delivery_curr'=> '此单发货数量',
        'storage'=> '库存',
        'subtotal'=> '小计',
        'label_total'=> '合计：',
        'label_total_weight'=> '商品总重量：',

        'label_goods_amount'=> '商品总金额：',
        'label_discount'=> '折扣：',
        'label_tax'=> '发票税额：',
        'label_shipping_fee'=> '配送费用：',
        'label_insure_fee'=> '保价费用：',
        'label_insure_yn'=> '是否保价：',
        'label_pay_fee'=> '支付费用：',
        'label_pack_fee'=> '包装费用：',
        'label_card_fee'=> '贺卡费用：',
        'label_money_paid'=> '已付款金额：',
        'label_surplus'=> '使用余额：',
        'label_integral'=> '使用积分：',
        'label_bonus'=> '使用红包：',
        'label_order_amount'=> '订单总金额：',
        'label_money_dues'=> '应付款金额：',
        'label_money_refund'=> '应退款金额：',
        'label_to_buyer'=> '商家给客户的留言：',
        'save_order'=> '保存订单',
        'notice_gb_order_amount'=> '（备注：团购如果有保证金，第一次只需支付保证金和相应的支付费用）',

        'action_user'=> '操作者：',
        'action_time'=> '操作时间',
        'order_status'=> '订单状态',
        'pay_status'=> '付款状态',
        'shipping_status'=> '发货状态',
        'action_note'=> '备注',
        'pay_note'=> '支付备注：',

        'sms_time_format'=> 'm月j日G时',
        'order_shipped_sms'=> '您的订单%s已于%s发货 [%s]',
        'order_splited_sms'=> '您的订单%s,%s正在%s [%s]',
        'order_removed'=> '订单删除成功。',
        'return_list'=> '返回订单列表',

        /* 订单处理提示 */
        'surplus_not_enough'=> '该订单使用 %s 余额支付，现在用户余额不足',
        'integral_not_enough'=> '该订单使用 %s 积分支付，现在用户积分不足',
        'bonus_not_available'=> '该订单使用红包支付，现在红包不可用',

        /* 购货人信息 */
        'display_buyer'=> '显示购货人信息',
        'buyer_info'=> '购货人信息',
        'pay_points'=> '消费积分',
        'rank_points'=> '等级积分',
        'user_money'=> '账户余额',
        'email'=> '电子邮件',
        'rank_name'=> '会员等级',
        'bonus_count'=> '红包数量',
        'zipcode'=> '邮编',
        'tel'=> '电话',
        'mobile'=> '备用电话',

        /* 合并订单 */
        'order_sn_not_null'=> '请填写要合并的订单号',
        'two_order_sn_same'=> '要合并的两个订单号不能相同',
        'order_not_exist'=> '定单 %s 不存在',
        'os_not_unconfirmed_or_confirmed'=> '%s 的订单状态不是“未确认”或“已确认”',
        'ps_not_unpayed'=> '订单 %s 的付款状态不是“未付款”',
        'ss_not_unshipped'=> '订单 %s 的发货状态不是“未发货”',
        'order_user_not_same'=> '要合并的两个订单不是同一个用户下的',
        'merge_invalid_order'=> '对不起，您选择合并的订单不允许进行合并的操作。',

        'from_order_sn'=> '从订单：',
        'to_order_sn'=> '主订单：',
        'merge'=> '合并',
        'notice_order_sn'=> '当两个订单不一致时，合并后的订单信息（如：支付方式、配送方式、包装、贺卡、红包等）以主订单为准。',
        'js_languages'=>['confirm_merge'=> '您确实要合并这两个订单吗？'],

        /* 批处理 */
        'pls_select_order'=> '请选择您要操作的订单',
        'no_fulfilled_order'=> '没有满足操作条件的订单。',
        'updated_order'=> '更新的订单：',
        'order'=> '订单：',
        'confirm_order'=> '以下订单无法设置为确认状态',
        'invalid_order'=> '以下订单无法设置为无效',
        'cancel_order'=> '以下订单无法取消',
        'remove_order'=> '以下订单无法被移除',

        /* 编辑订单打印模板 */
        'edit_order_templates'=> '编辑订单打印模板',
        'template_resetore'=> '还原模板',
        'edit_template_success'=> '编辑订单打印模板操作成功!',
        'remark_fittings'=> '（配件）',
        'remark_gift'=> '（赠品）',
        'remark_favourable'=> '（特惠品）',
        'remark_package'=> '（礼包）',

        /* 订单来源统计 */
        'from_order'=> '订单来源：',
        'from_ad_js'=> '广告：',
        'from_goods_js'=> '商品站外JS投放',
        'from_self_site'=> '来自本站',
        'from'=> '来自站点：',

        /* 添加、编辑订单 */
        'add_order'=> '添加订单',
        'edit_order'=> '编辑订单',
        'step'=>[
            'user'=> '请选择您要为哪个会员下订单',
            'goods'=> '选择商品',
            'consignee'=> '设置收货人信息',
            'shipping'=> '选择配送方式',
            'payment'=> '选择支付方式',
            'other'=> '设置其他信息',
            'money'=> '设置费用,'
        ],
        'anonymous'=> '匿名用户',
        'by_useridname'=> '按会员编号或会员名搜索',
        'button_prev'=> '上一步',
        'button_next'=> '下一步',
        'button_finish'=> '完成',
        'button_cancel'=> '取消',
        'name'=> '名称',
        'desc'=> '描述',
        'shipping_fee'=> '配送费',
        'free_money'=> '免费额度',
        'insure'=> '保价费',
        'pay_fee'=> '手续费',
        'pack_fee'=> '包装费',
        'card_fee'=> '贺卡费',
        'no_pack'=> '不要包装',
        'no_card'=> '不要贺卡',
        'add_to_order'=> '加入订单',
        'calc_order_amount'=> '计算订单金额',
        'available_surplus'=> '可用余额：',
        'available_integral'=> '可用积分：',
        'available_bonus'=> '可用红包：',
        'admin'=> '管理员添加',
        'search_goods'=> '按商品编号或商品名称或商品货号搜索',
        'category'=> '分类',
        'brand'=> '品牌',
        'user_money_not_enough'=> '用户余额不足',
        'pay_points_not_enough'=> '用户积分不足',
        'money_paid_enough'=> '已付款金额比商品总金额和各种费用之和还多，请先退款',
        'price_note'=> '备注：商品价格中已包含属性加价',
        'select_pack'=> '选择包装',
        'select_card'=> '选择贺卡',
        'select_shipping'=> '请先选择配送方式',
        'want_insure'=> '我要保价',
        'update_goods'=> '更新商品',
        'notice_user'=> '<strong>注意：</strong>搜索结果只显示前20条记录，如果没有找到相' .
            '应会员，请更精确地查找。另外，如果该会员是从论坛注册的且没有在商城登录过，' .
            '也无法找到，需要先在商城登录。',
        'amount_increase'=> '由于您修改了订单，导致订单总金额增加，需要再次付款',
        'amount_decrease'=> '由于您修改了订单，导致订单总金额减少，需要退款',
        'continue_shipping'=> '由于您修改了收货人所在地区，导致原来的配送方式不再可用，请重新选择配送方式',
        'continue_payment'=> '由于您修改了配送方式，导致原来的支付方式不再可用，请重新选择配送方式',
        'refund'=> '退款',
        'cannot_edit_order_shipped'=> '您不能修改已发货的订单',
        'address_list'=> '从已有收货地址中选择：',
        'order_amount_change'=> '订单总金额由 %s 变为 %s',
        'shipping_note'=> '说明：因为订单已发货，修改配送方式将不会改变配送费和保价费。',
        'change_use_surplus'=> '编辑订单 %s ，改变使用预付款支付的金额',
        'change_use_integral'=> '编辑订单 %s ，改变使用积分支付的数量',
        'return_order_surplus'=> '由于取消、无效或退货操作，退回支付订单 %s 时使用的预付款',
        'return_order_integral'=> '由于取消、无效或退货操作，退回支付订单 %s 时使用的积分',
        'order_gift_integral'=> '订单 %s 赠送的积分',
        'return_order_gift_integral'=> '由于退货或未发货操作，退回订单 %s 赠送的积分',
        'invoice_no_mall'=> '&nbsp,&nbsp,&nbsp,&nbsp,多个发货单号，请用英文逗号（“,”）隔开。',

        'js_languages'=>[
                'input_price'=> '自定义价格',
                'pls_search_user'=> '请搜索并选择会员',
                'confirm_drop'=> '确认要删除该商品吗？',
                'invalid_goods_number'=> '商品数量不正确',
                'pls_search_goods'=> '请搜索并选择商品',
                'pls_select_area'=> '请完整选择所在地区',
                'pls_select_shipping'=> '请选择配送方式',
                'pls_select_payment'=> '请选择支付方式',
                'pls_select_pack'=> '请选择包装',
                'pls_select_card'=> '请选择贺卡',
                'pls_input_note'=> '请您填写备注！',
                'pls_input_cancel'=> '请您填写取消原因！',
                'pls_select_refund'=> '请选择退款方式！',
                'pls_select_agency'=> '请选择办事处！',
                 'pls_select_other_agency'=> '该订单现在就属于这个办事处，请选择其他办事处！',
                 'loading'=> '加载中...',
            ],
        /* 订单操作 */
        'order_operate'=> '订单操作：',
        'label_refund_amount'=> '退款金额：',
        'label_handle_refund'=> '退款方式：',
        'label_refund_note'=> '退款说明：',
        'return_user_money'=> '退回用户余额',
        'create_user_account'=> '生成退款申请',
        'not_handle'=> '不处理，误操作时选择此项',

        'order_refund'=> '订单退款：%s',
        'order_pay'=> '订单支付：%s',

        'send_mail_fail'=> '发送邮件失败',

        'send_message'=> '发送/查看留言',

        /* 发货单操作 */
        'delivery_operate'=> '发货单操作：',
        'delivery_sn_number'=> '发货单流水号：',
        'invoice_no_sms'=> '请填写发货单号！',

        /* 发货单搜索 */
        'delivery_sn'=> '发货单',

        /* 发货单状态 */
        'delivery_status'=>[
            0=> '已发货',
            1=> '退货',
            2=> '正常'
        ],
        /* 发货单标签 */
        'label_delivery_status'=> '发货单状态',
        'label_suppliers_name'=> '供货商',
        'label_delivery_time'=> '生成时间',
        'label_delivery_sn'=> '发货单流水号',
        'label_add_time'=> '下单时间',
        'label_update_time'=> '发货时间',
        'label_send_number'=> '发货数量',

        /* 发货单提示 */
        'tips_delivery_del'=> '发货单删除成功！',

        /* 退货单操作 */
        'back_operate'=> '退货单操作：',

        /* 退货单标签 */
        'return_time'=> '退货时间：',
        'label_return_time'=> '退货时间',

        /* 退货单提示 */
        'tips_back_del'=> '退货单删除成功！',

        'goods_num_err'=> '库存不足，请重新选择！',

        /* 会员订单 */
        'order_list_lnk'=>'我的订单列表',
        'order_number'=>'订单编号',
        'order_addtime'=>'下单时间',
        'order_money'=>'订单总金额',
        'order_status'=>'订单状态',
        'first_order'=>'主订单',
        'second_order'=>'从订单',
        'merge_order'=>'合并订单',
        'no_priv'=>'你没有权限操作他人订单',
        'buyer_cancel'=>'用户取消',
        'cancel'=>'取消订单',
        'pay_money'=>'立即支付',
        'view_order'=>'查看订单',
        'received'=>'确认收货',
        'ss_received'=>'已完成',
        'confirm_cancel'=>'您确认要取消该订单吗？取消后此订单将视为无效订单',
        'merge_ok'=>'订单合并成功！',
        'merge_invalid_order'=>'对不起，您选择合并的订单不允许进行合并的操作。',
        'select'=>'请选择...',
        'order_not_pay'=>"你的订单状态为 %s ,不需要付款",
        'order_sn_empty'=>'合并主订单号不能为空',
        'merge_order_notice'=>'订单合并是在发货前将相同状态的订单合并成一新的订单。<br />收货地址，送货方式等以主定单为准。',
        'order_exist'=>'该订单不存在！',
        'order_is_group_buy'=>'[团购]',
        'order_is_exchange'=>'[积分商城]',
        'gb_deposit'=>'（保证金）',
        'notice_gb_order_amount'=>'（备注：团购如果有保证金，第一次只需支付保证金和相应的支付费用）',
        'business_message'=>'发送/查看商家留言',
        'pay_order_by_surplus'=>'追加使用余额支付订单：%s',
        'return_surplus_on_cancel'=>'取消订单 %s，退回支付订单时使用的预付款',
        'return_integral_on_cancel'=>'取消订单 %s，退回支付订单时使用的积分',

        'shop_notice' => '商店公告',
        'order_invalid' => '您提交的订单不正确.',
        'receive' => '收货确认',
        'order_already_received' => '此订单已经确认过了，感谢您在本站购物，欢迎再次光临。',
        'buyer' => '买家',
        'seller' => '商户',

    ];
    /**
     * 载入配置信息
     *
     * @access  public
     * @return  array
     */
    public static function load_config()
    {
        $arr = array();
        $key = md5('xfjb_shop_config');
        $data = Cache::get($key);
        if (!$data) {
            $res = \App\Models\ShopConfig::select('code','value')->where('parent_id','>','0')->get()->toArray();
            foreach ($res AS $row) {
                $arr[$row['code']] = $row['value'];
            }

            /* 对数值型设置处理 */
            $arr['watermark_alpha'] = intval($arr['watermark_alpha']);
            $arr['market_price_rate'] = floatval($arr['market_price_rate']);
            $arr['integral_scale'] = floatval($arr['integral_scale']);
            //$arr['integral_percent']     = floatval($arr['integral_percent']);
            $arr['cache_time'] = intval($arr['cache_time']);
            $arr['thumb_width'] = intval($arr['thumb_width']);
            $arr['thumb_height'] = intval($arr['thumb_height']);
            $arr['image_width'] = intval($arr['image_width']);
            $arr['image_height'] = intval($arr['image_height']);
            $arr['best_number'] = !empty($arr['best_number']) && intval($arr['best_number']) > 0 ? intval($arr['best_number']) : 3;
            $arr['new_number'] = !empty($arr['new_number']) && intval($arr['new_number']) > 0 ? intval($arr['new_number']) : 3;
            $arr['hot_number'] = !empty($arr['hot_number']) && intval($arr['hot_number']) > 0 ? intval($arr['hot_number']) : 3;
            $arr['promote_number'] = !empty($arr['promote_number']) && intval($arr['promote_number']) > 0 ? intval($arr['promote_number']) : 3;
            $arr['top_number'] = intval($arr['top_number']) > 0 ? intval($arr['top_number']) : 10;
            $arr['history_number'] = intval($arr['history_number']) > 0 ? intval($arr['history_number']) : 5;
            $arr['comments_number'] = intval($arr['comments_number']) > 0 ? intval($arr['comments_number']) : 5;
            $arr['article_number'] = intval($arr['article_number']) > 0 ? intval($arr['article_number']) : 5;
            $arr['page_size'] = intval($arr['page_size']) > 0 ? intval($arr['page_size']) : 10;
            $arr['bought_goods'] = intval($arr['bought_goods']);
            $arr['goods_name_length'] = intval($arr['goods_name_length']);
            $arr['top10_time'] = intval($arr['top10_time']);
            $arr['goods_gallery_number'] = intval($arr['goods_gallery_number']) ? intval($arr['goods_gallery_number']) : 5;
            $arr['no_picture'] = !empty($arr['no_picture']) ? str_replace('../', './', $arr['no_picture']) : 'images/no_picture.gif'; // 修改默认商品图片的路径
            $arr['qq'] = !empty($arr['qq']) ? $arr['qq'] : '';
            $arr['ww'] = !empty($arr['ww']) ? $arr['ww'] : '';
            $arr['default_storage'] = isset($arr['default_storage']) ? intval($arr['default_storage']) : 1;
            $arr['min_goods_amount'] = isset($arr['min_goods_amount']) ? floatval($arr['min_goods_amount']) : 0;
            $arr['one_step_buy'] = empty($arr['one_step_buy']) ? 0 : 1;
            $arr['invoice_type'] = empty($arr['invoice_type']) ? array('type' => array(), 'rate' => array()) : unserialize($arr['invoice_type']);
            $arr['show_order_type'] = isset($arr['show_order_type']) ? $arr['show_order_type'] : 0;    // 显示方式默认为列表方式
            $arr['help_open'] = isset($arr['help_open']) ? $arr['help_open'] : 1;    // 显示方式默认为列表方式

            if (!isset($GLOBALS['_CFG']['ecs_version'])) {
                /* 如果没有版本号则默认为2.0.5 */
                $GLOBALS['_CFG']['ecs_version'] = 'v2.0.5';
            }

            //限定语言项
            $lang_array = array('zh_cn', 'zh_tw', 'en_us');
            if (empty($arr['lang']) || !in_array($arr['lang'], $lang_array)) {
                $arr['lang'] = 'zh_cn'; // 默认语言为简体中文
            }

            if (empty($arr['integrate_code'])) {
                $arr['integrate_code'] = 'ecshop'; // 默认的会员整合插件为 ecshop
            }
            $expiresAt = 60*24*30;
            Cache::put($key, $arr,$expiresAt);
        } else {
            $arr = $data;
        }

        $ua = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        $uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|jiabeiapp|cldc|midp|mobile)/i";
        if (($ua == '' || preg_match($uachar, $ua)) && !strpos(strtolower($_SERVER['REQUEST_URI']), 'wap')) {
            $arr['template'] = 'wap';
            $_SESSION['theme'] = 'wap';
        }
        if (\Helper\CFunctionHelper::get_device_type() == true || \Helper\CFunctionHelper::isMobile() == true) {
            $arr['template'] = 'wap';
            $_SESSION['theme'] = 'wap';
        }
        return $arr;
    }



}
