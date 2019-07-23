<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminCompanyRequest;
use Illuminate\Http\Request;
use App\Services\GiftCompanyService;

class GiftCompanyController extends BaseController
{
    protected $giftCompanyService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(GiftCompanyService $giftCompanyService)
    {
        $this->giftCompanyService = $giftCompanyService;
    }

	/**
	 * 公司列表
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
        $companyList = $this->giftCompanyService->companyList();
        return $this->view(null, compact('companyList'));
    }

	/**
	 * 添加公司页面
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

    public function create()
    {
        return view('admin.giftCompany.create');
    }

	/**
	 * 添加公司成功
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @param AdminGoodsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(AdminCompanyRequest $request)
    {
    	$this->giftCompanyService->create($request);

        flash('添加公司成功')->success()->important();

        return redirect()->route('giftCompany.index');
    }


	/**
	 * 编辑公司页面
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function edit($id)
    {
    	$company = $this->giftCompanyService->ById($id);
        return view('admin.giftCompany.edit', compact('company'));
    }

	/**
	 * 更新公司信息
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param AdminGoodsRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(AdminCompanyRequest $request,$id)
    {
    	$this->giftCompanyService->update($request,$id);

        flash('更新公司信息')->success()->important();

        return redirect()->route('giftCompany.index');
    }

	/**
	 * 删除公司
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function delete($id)
    {
		$company = $this->giftCompanyService->ById($id);

        if(empty($company))
        {
            flash('删除失败')->error()->important();

            return redirect()->route('giftCompany.index');
        }
		$company->delete();

        flash('删除成功')->success()->important();

        return redirect()->route('giftCompany.index');
    }

	/**
	 * 公司上下架
	 * @author: colin
	 * @date: 2018/12/18 10:57
	 * @param $status
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function status($status,$id)
    {
    	$company = $this->giftCompanyService->ById($id);
        if(empty($company))
        {
            flash('操作失败')->error()->important();

            return redirect()->route('giftGoods.index');
        }

		$company->update(['status'=>$status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('giftCompany.index');
    }
}
