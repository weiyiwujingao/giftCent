<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminGroupRequest;
use App\Http\Requests\Admin\AdminGroupStoreRequest;
use Illuminate\Http\Request;
use App\Services\GiftGroupService;
use App\Repositories\RolesRepository;

class GiftGroupController extends BaseController
{
    protected $giftService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(GiftGroupService $giftGroupService)
    {
        $this->giftGroupService = $giftGroupService;
    }

    /**
     * 套餐组合列表
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = $this->giftGroupService->getGroupList();
        $search = \Request::all();
        return $this->view(null, compact('groups', 'search'));
    }

    /**
     * 添加套餐组合页面
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        //AdminGroupRequest $request
        $goodsInfo = [];//$this->giftGroupService->goodsInfo($request);
        return view('admin.giftGroup.create', compact('goodsInfo'));
    }

    /**
     * 搜索
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $resList = $this->giftGroupService->getListByName();
        return response()->json([
            'status' => 1,
            'data'   => $resList,
        ]);
    }

    /**
     * 添加套餐组合成功
     * @author: colin
     * @date: 2018/12/18 10:55
     * @param AdminGoodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminGroupStoreRequest $request)
    {
        $this->giftGroupService->create($request);
        flash('添加套餐成功')->success()->important();
        return redirect()->route('giftGroup.index');
    }


    /**
     * 编辑套餐组合页面
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $groupInfo = $this->giftGroupService->ById($id);
        return view('admin.giftGroup.edit', compact('groupInfo'));
    }

    /**
     * 更新套餐组合信息
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param AdminGoodsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminGroupStoreRequest $request, $id)
    {
        $this->giftGroupService->update($request, $id);

        flash('更新套餐组合信息')->success()->important();

        return redirect()->route('giftGroup.index');
    }

    /**
     * 删除套餐组合
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $groupInfo = $this->giftGroupService->ById($id);
        $cardTypeName = $this->giftGroupService->getNameInsetById($id);

        if (!empty($cardTypeName)) {
            flash('删除失败，已存在卡类型')->error()->important();
            return redirect()->route('giftGroup.index');
        }
        if (empty($groupInfo)) {
            flash('删除失败')->error()->important();

            return redirect()->route('giftGroup.index');
        }
        $groupInfo->delete();

        flash('删除成功')->success()->important();

        return redirect()->route('giftGroup.index');
    }

    /**
     * 套餐组合上下架
     * @author: colin
     * @date: 2018/12/18 10:57
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status, $id)
    {
        $groupInfo = $this->giftGroupService->ById($id);
        if (empty($groupInfo)) {
            flash('操作失败')->error()->important();

            return redirect()->route('giftGroup.index');
        }

        $groupInfo->update(['status' => $status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('giftGroup.index');
    }
}
