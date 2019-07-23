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

use App\Models\GiftGoodCat;

class GiftGoodCatRepository
{
    /**
     * 创建商品分类
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftGoodCat::create($params);
    }
    /**
     * 根据id获取商品分类资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return GiftGoodCat::with('cats')->find($id);
    }

    /**
     * 获取商品分类列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCats()
    {
        return GiftGoodCat::with('cats')->oldest('id')->where('parent_id',0)->get();
    }
	/**
	 * 获取商品分类列表 with ('roles')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getCatlist()
	{
		return GiftGoodCat::with('cats')->oldest('id')->where('parent_id',0)->paginate(10);
	}

    /**
     * 根据name查询商品分类资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftGood::where('name',$name)->first();
    }
}