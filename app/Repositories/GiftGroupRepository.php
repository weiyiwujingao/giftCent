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

use App\Models\GiftGroup;

class GiftGroupRepository
{
    /**
     * 创建商品
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftGroup::create($params);
    }
	/**
	 * 根据id获取商品资料
	 * @param $id
	 * @return mixed
	 */
	public function ById($id)
	{
		return GiftGroup::find($id);
	}
    /**
     * 根据id获取商品资料
     * @param $id
     * @return mixed
     */
    public function ByIdWithCats($id)
    {
        return GiftGroup::with('cats')->find($id);
    }

    /**
     * 获取商品列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGroupList($where)
    {
        return GiftGroup::where($where)->latest('create_time')->paginate('10');
    }
	/**
	 * 获取商品列表 with ('roles')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getGoods($ids)
	{
		return GiftGroup::whereIn('id',$ids)->latest('create_time')->get();
	}
	/**
	 * 根据id获取名称
	 * @param $ids
	 * @return mixed
	 */
	public function getNameByIds($ids)
	{
		return GiftGroup::whereIn('id',$ids)->pluck('name');
	}
	/**
	 * 根据ids获取信息
	 * @param $ids
	 * @return mixed
	 */
	public function ByIds($ids)
	{
		return GiftGroup::whereIn('id',$ids)->get();
	}
    /**
     * 根据name查询商品资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftGroup::where('name',$name)->first();
    }
	/**
	 * 根据catid获取商品资料
	 * @param $id
	 * @return mixed
	 */
	public function ByCatId($catId)
	{
		return GiftGroup::where('cat_id',$catId)->first();
	}

	/**
	 * 根据商品id获取套餐
	 * @author: colin
	 * @date: 2018/12/25 12:09
	 * @param $id
	 * @return mixed
	 */
	public function InsetById($id)
	{
		return GiftGroup::whereRaw(" find_in_set($id,gs_ids) ")->first();
	}
}