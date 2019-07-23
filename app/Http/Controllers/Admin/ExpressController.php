<?php

namespace App\Http\Controllers\Admin;

use App\Services\ExpressService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminAddExpressRequest;
use App\Http\Requests\Admin\AdminStoreOderExpressRequest;
use App\Repositories\GiftExpressInfoRepository as expressInfo ;

class ExpressController extends BaseController
{
    protected $giftService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(ExpressService $expressService)
    {
        $this->expressService = $expressService;
    }

    /**
     * 物流列表
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$list = $this->expressService->list();
        $search = \Request::all();
        return $this->view(null, compact('list','search'));
    }

    /**
     * 添加物流页面
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create(AdminAddExpressRequest $request)
    {
        $orderSn = $request->input('order_sn');
		$express = expressInfo::list();
        return view('admin.express.create', compact('orderSn','express'));
    }
    /**
     * 添加物流成功
     * @author: colin
     * @date: 2018/12/18 10:55
     * @param AdminGoodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminStoreOderExpressRequest $request)
    {
        $this->expressService->create($request);

        flash('添加物流成功')->success()->important();

        return redirect()->route('express.index', ['order_sn' => $request->order_sn]);
    }


    /**
     * 编辑物流页面
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $good = $this->expressService->ById($id);
        $cats = $this->expressService->getCats();
        return view('admin.express.edit', compact('good', 'cats'));
    }

    /**
     * 更新物流信息
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param AdminGoodsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminGoodsRequest $request, $id)
    {
        $this->expressService->update($request, $id);
        flash('更新物流信息成功')->success()->important();
        return redirect()->route('express.index');
    }

    /**
     * 删除物流
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $good = $this->expressService->ById($id);

        if (empty($good)) {
            flash('删除失败')->error()->important();
        } else {
            $good->delete();
            flash('删除成功')->success()->important();
        }
        return redirect()->back();
    }
	/***
	 * 快递详情查看
	 * @author: colin
	 * @date: 2018/11/19 11:33
	 * @return $this|\Illuminate\Http\JsonResponse
	 */
	public function expressDetail()
	{
		$expressDetail = $this->expressService->expressDetail();
		if ($expressDetail === false) {
			return self::showError('暂无信息');
		}
		return self::showSuccess($expressDetail);
	}




}
