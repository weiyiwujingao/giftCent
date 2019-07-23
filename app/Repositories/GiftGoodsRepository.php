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

use App\Models\GiftGood;

class GiftGoodsRepository
{
    /**
     * 创建商品
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftGood::create($params);
    }

    /**
     * 根据id获取商品资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return GiftGood::find($id);
    }

    /**
     * 根据id获取商品名称
     * @param $id
     * @return mixed
     */
    public function getNameByIds($ids)
    {
        return GiftGood::whereIn('id', $ids)->pluck('name');
    }

    /**
     * 根据id获取商品资料
     * @param $id
     * @return mixed
     */
    public function ByIds($ids)
    {
        return GiftGood::with('cats')->whereIn('id', $ids)->get();
    }

    /**
     * 根据id获取商品资料
     * @param $id
     * @return mixed
     */
    public function ByIdWithCats($id)
    {
        return GiftGood::with('cats')->find($id);
    }

    /**
     * 获取商品列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGoodsWithCats($where)
    {
        $perPage = intval(\Request::input('num')) > 0 ? intval(\Request::input('num')) : 10;
        return GiftGood::with('cats')->where($where)->latest('create_time')->paginate($perPage);
    }

    /**
     * 商品
     * @param $where
     * @return mixed
     */
    public function getGoodsListByName($where)
    {
        return GiftGood::where($where)->limit(10)->get();
    }

    /**
     * 获取商品列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGoods($ids)
    {
        return GiftGood::whereIn('id', $ids)->latest('create_time')->get();
    }

    /**
     * 根据name查询商品资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftGood::where('name', $name)->first();
    }

    /**
     * 根据catid获取商品资料
     * @param $id
     * @return mixed
     */
    public function ByCatId($catId)
    {
        return GiftGood::where('cat_id', $catId)->first();
    }

    /**
     * 根据where条件统计数量
     * @author: colin
     * @date: 2018/12/28 10:36
     * @param $where
     */
    public function CountNum($where)
    {
        return GiftGood::whereRaw($where)->count();
    }
}