<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminGoodsRequest;
use App\Services\GiftService;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class GiftGoodsController extends BaseController
{
    protected $giftService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(GiftService $giftService)
    {
        $this->giftService = $giftService;
    }

    /**
     * 商品列表
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $goods = $this->giftService->getGoodsWithCats();
        $search = \Request::all();
        return $this->view(null, compact('goods', 'search'));
    }

    /**
     * 搜索
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $resList = $this->giftService->getGoodsListByName();
        return response()->json([
            'status' => 1,
            'data'   => $resList,
        ]);
    }

    /**
     * 添加商品页面
     * @author: colin
     * @date: 2018/12/18 10:55
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        $cats = $this->giftService->getCats();

        return view('admin.giftGoods.create', compact('cats'));
    }

    /**
     * 添加商品成功
     * @author: colin
     * @date: 2018/12/18 10:55
     * @param AdminGoodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminGoodsRequest $request)
    {
        $this->giftService->create($request);

        flash('添加商品成功')->success()->important();

        return redirect()->route('giftGoods.index');
    }


    /**
     * 编辑商品页面
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $good = $this->giftService->ById($id);
        $cats = $this->giftService->getCats();
        return view('admin.giftGoods.edit', compact('good', 'cats'));
    }

    /**
     * 更新商品信息
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param AdminGoodsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminGoodsRequest $request, $id)
    {
        $this->giftService->update($request, $id);
        flash('更新商品信息成功')->success()->important();
        return redirect()->route('giftGoods.index');
    }

    /**
     * 删除商品
     * @author: colin
     * @date: 2018/12/18 10:56
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $good = $this->giftService->ById($id);
        $group = $this->giftService->InsetById($id);
        if (!empty($group->name)) {
            flash('存在商品套餐，不能直接删除！')->error()->important();
            return redirect()->back();
        }
        if (empty($good)) {
            flash('删除失败')->error()->important();
        } else {
            $good->delete();
            flash('删除成功')->success()->important();
        }
        return redirect()->back();
    }

    /**
     * 商品上下架
     * @author: colin
     * @date: 2018/12/18 10:57
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status, $id)
    {
        $good = $this->giftService->ById($id);
        if (empty($good)) {
            flash('操作失败')->error()->important();
        } else {
            $good->update(['status' => $status]);
            flash('更新状态成功')->success()->important();
        }
        return redirect()->back();
    }

    /**
     * 上传图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');//获取图片
        $allowedExtensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
            return response()->json([
                'status'  => 0,
                'message' => '只能上传 png | jpg | gif格式的图片',
            ]);
        }

        $destinationPath = 'uploads/goods/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        return Response()->json(
            [
                'status'  => 1,
                'data'    => $destinationPath . $fileName,
                'message' => '上传成功！',
            ]
        );
    }

}
