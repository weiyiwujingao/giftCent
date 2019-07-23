<?php
namespace App\Repositories;

use App\Models\GiftCompay;

class GiftCompanyRepository
{
    /**
     * 创建公司
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftCompay::create($params);
    }
	/**
	 * 根据id获取公司资料
	 * @param $id
	 * @return mixed
	 */
	public function ById($id)
	{
		return GiftCompay::find($id);
	}
	/**
	 * 根据id获取公司名称
	 * @param $id
	 * @return mixed
	 */
	public function getNameByIds($ids)
	{
		return GiftCompay::whereIn('id',$ids)->pluck('name');
	}
	/**
	 * 根据id获取公司资料
	 * @param $id
	 * @return mixed
	 */
	public function ByIds($ids)
	{
		return GiftCompay::whereIn('id',$ids)->get();
	}
    /**
     * 获取公司列表
     * @param $id
     * @return mixed
     */
    public function companyList()
    {
        return GiftCompay::latest('create_time')->paginate('10');
    }
	/**
	 * 获取公司列表
	 * @param $id
	 * @return mixed
	 */
	public function company($where=['status'=>1])
	{
		return GiftCompay::where($where)->latest('create_time')->get();
	}
    /**
     * 根据name查询公司资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftCompay::where('name',$name)->first();
    }
	/**
	 * 根据catid获取公司资料
	 * @param $id
	 * @return mixed
	 */
	public function ByCatId($catId)
	{
		return GiftCompay::where('cat_id',$catId)->first();
	}
}