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

use App\Models\GiftExpressInfo;

class GiftExpressInfoRepository
{
    /**
     * 创建物流公司
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftExpressInfo::create($params);
    }
	/**
	 * 根据id获取物流公司资料
	 * @param $id
	 * @return mixed
	 */
	public function ById($id)
	{
		return GiftExpressInfo::find($id);
	}
	/**
	 * 物流公司列表
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public static function list()
	{
		return GiftExpressInfo::oldest('ex_id')->get();
	}

}