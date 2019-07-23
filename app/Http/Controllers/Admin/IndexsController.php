<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\IndexsService;

class IndexsController extends Controller
{
	protected $indexsService;

	/**
	 * AdminsController constructor.
	 * @param AdminsService $adminsService
	 * @param RolesRepository $rolesRepository
	 */
	public function __construct(IndexsService $indexsService)
	{
		$this->indexsService = $indexsService;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.indexs.index');
    }

	/**
	 * 首页数据分析页面
	 * @author: colin
	 * @date: 2018/12/28 11:08
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function main()
    {

    	return view('admin.indexs.main');
    }
	/**
	 * 获取系统消息
	 * @author: colin
	 * @date: 2018/12/28 11:09
	 */
    public function mainData()
	{
		$dataInfo = $this->indexsService->dataInfo();
		if ($dataInfo === false) {
			return self::showError('暂无信息');
		}
		return self::showSuccess($dataInfo);
	}
}
