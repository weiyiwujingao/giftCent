<?php

namespace App\Services;

use App\Repositories\GiftCompanyRepository;
use App\Repositories\GiftGoodCatRepository;

class GiftCompanyService
{

    protected $giftCompanyRepository;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftCompanyRepository $giftCompanyRepository)
    {
        $this->giftCompanyRepository = $giftCompanyRepository;
    }
	/**
	 * 获取公司列表 with ('cats')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function companyList()
	{
		return $this->giftCompanyRepository->companyList();
	}
	/**
	 * 获取公司列表 with ('cats')
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function company()
	{
		return $this->giftCompanyRepository->company();
	}
    /**
     * 添加公司
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        $dataInfo = [
        	'name' => $datas['name'],
        	'en_name' => $datas['en_name'],
        	'status' => $datas['status'],
		];
        $admin = $this->giftCompanyRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新公司资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $good = $this->giftCompanyRepository->ById($id);
        if(empty($good))
        	return false;

		$good->update($datas);

		return $good;
    }

    /**
     * 获取公司的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftCompanyRepository->ById($id);
    }

}