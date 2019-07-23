<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/13
 * Time: 上午9:54
 */
namespace App\Repositories;

use App\Models\GiftOrderExpress;

class GiftOderExpressRepository
{
    /**
     * 创建订单物流
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftOrderExpress::create($params);
    }
	/**
	 * 根据id获取订单物流资料
	 * @param $id
	 * @return mixed
	 */
	public function ById($id)
	{
		return GiftOrderExpress::find($id);
	}
	/**
	 * 根据order_sn获取订单物流资料
	 * @param $orderSn
	 * @return mixed
	 */
	public function ByOrderSn($orderSn)
	{
		return GiftOrderExpress::with('exInfo')->where('order_sn',$orderSn)->first();
	}

	/**
	 * 获取订单物流标号
	 * @author: colin
	 * @date: 2018/12/20 18:16
	 */
	public function getOrderSn($orderSn)
	{
		return GiftOrderExpress::where('order_sn',$orderSn)->value('order_sn');
	}

	/**
	 * 后台订单物流列表
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function list($where)
	{
		return GiftOrderExpress::where($where)->with('exInfo')->with('exDetail')->latest('create_time')->paginate('10');
	}

}