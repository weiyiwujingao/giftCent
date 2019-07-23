<?php

namespace App\Services;

use App\Repositories\GiftGoodsRepository;
use App\Repositories\GiftGoodCatRepository;

class GiftCatsService
{
    protected $giftGoodCatRepository;
    protected $giftGoodsRepository;
    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftGoodsRepository $giftGoodsRepository,GiftGoodCatRepository $giftGoodCatRepository)
    {
        $this->giftGoodCatRepository = $giftGoodCatRepository;
        $this->giftGoodsRepository = $giftGoodsRepository;
    }
	/**
	 * 获取商品分类列表 with ('cats')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getCatlist()
	{
		return $this->giftGoodCatRepository->getCatlist();
	}
	/**
	 * 获取商品分类列表 with ('cats')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getCats()
	{
		return $this->giftGoodCatRepository->getCats();
	}
    /**
     * 添加商品分类
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        $dataInfo = [
        	'name' => $datas['name'],
        	'parent_id' => $datas['parent_id'],
        	'status' => $datas['status'],
		];
        $admin = $this->giftGoodCatRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新商品分类资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $good = $this->giftGoodCatRepository->ById($id);
        if(empty($good))
        	return false;

		$good->update($datas);

		return $good;
    }

    /**
     * 获取商品分类的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftGoodCatRepository->ById($id);
    }

	/**
	 * 获取商品信息
	 * @author: colin
	 * @date: 2018/12/18 14:55
	 * @param $catId
	 * @return mixed
	 */
    public function ByCatId($catId)
	{
		return $this->giftGoodsRepository->ByCatId($catId);
	}

}