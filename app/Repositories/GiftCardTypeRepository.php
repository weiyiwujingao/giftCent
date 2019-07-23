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

use App\Models\GiftCardType;


class GiftCardTypeRepository
{
    /**
     * 创建礼品卡类型
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftCardType::create($params);
    }
	/**
	 * 根据id获取礼品卡类型资料
	 * @param $id
	 * @return mixed
	 */
	public function ById($id)
	{
		return GiftCardType::find($id);
	}
	/**
	 * 根据id获取礼品卡类型名称
	 * @param $id
	 * @return mixed
	 */
	public function getNameByIds($ids)
	{
		return GiftCardType::whereIn('id',$ids)->pluck('name');
	}
	/**
	 * 根据id获取礼品卡类型资料
	 * @param $id
	 * @return mixed
	 */
	public function ByIds($ids)
	{
		return GiftCardType::whereIn('id',$ids)->get();
	}
    /**
     * 根据id获取礼品卡类型资料
     * @param $id
     * @return mixed
     */
    public function ByIdWithCats($id)
    {
        return GiftCardType::with('cats')->find($id);
    }

    /**
     * 获取礼品卡类型列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($where)
    {
		$perPage = intval(\Request::input('num'))>0? intval(\Request::input('num')) : 10;
    	return GiftCardType::where($where)->latest('create_time')->with('company')->paginate($perPage);
    }
	/**
	 * 获取礼品卡类型列表 with ('roles')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getGoods($ids)
	{
		return GiftCardType::whereIn('id',$ids)->latest('create_time')->get();
	}

    /**
     * 根据name查询礼品卡类型资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftCardType::where('name',$name)->first();
    }
	/**
	 * 根据catid获取礼品卡类型资料
	 * @param $id
	 * @return mixed
	 */
	public function ByCatId($catId)
	{
		return GiftCardType::where('cat_id',$catId)->first();
	}
	/**
	 * 根据套餐id获取卡类型名称
	 * @author: colin
	 * @date: 2018/12/25 12:09
	 * @param $id
	 * @return mixed
	 */
	public function getNameInsetById($id)
	{
		return GiftCardType::whereRaw(" find_in_set($id,gr_ids) ")->value('name');
	}
}