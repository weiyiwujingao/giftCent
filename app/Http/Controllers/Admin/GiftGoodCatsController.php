<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminGoodCatsRequest;
use App\Services\GiftCatsService;

class GiftGoodCatsController extends BaseController
{
    protected $giftService;

	/**
	 * GiftGoodCatsController constructor.
	 * @param GiftCatsService $giftCatsService
	 */
    public function __construct(GiftCatsService $giftCatsService)
    {
        $this->giftCatsService = $giftCatsService;
    }

	/**
	 * 商品类别列表
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
        $cats = $this->giftCatsService->getCatlist();

        return $this->view(null, compact('cats'));
    }

	/**
	 * 添加商品类别页面
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

    public function create()
    {
		$cats = $this->giftCatsService->getCats();
		return view('admin.giftGoodCats.create', compact('cats'));
    }

	/**
	 * 添加商品类别成功
	 * @author: colin
	 * @date: 2018/12/18 10:55
	 * @param AdminGoodsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(AdminGoodCatsRequest $request)
    {
    	$this->giftCatsService->create($request);

        flash('添加商品类别成功')->success()->important();

        return redirect()->route('giftGoodCats.index');
    }


	/**
	 * 编辑商品类别页面
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function edit($id)
    {
		$catInfo = $this->giftCatsService->ById($id);
		$cats = $this->giftCatsService->getCats($id);
        return view('admin.giftGoodCats.edit', compact('catInfo','cats'));
    }

	/**
	 * 更新商品类别信息
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param AdminGoodsRequest $request
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(AdminGoodCatsRequest $request,$id)
    {
        $this->giftCatsService->update($request,$id);

        flash('更新商品类别信息')->success()->important();

        return redirect()->route('giftGoodCats.index');
    }

	/**
	 * 删除商品类别
	 * @author: colin
	 * @date: 2018/12/18 10:56
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function delete($id)
    {
		$catInfo = $this->giftCatsService->ById($id);
		$goodInfo = $this->giftCatsService->ByCatId($id);

        if(empty($catInfo) || !empty($goodInfo))
        {
            flash('删除失败')->error()->important();

            return redirect()->route('giftGoodCats.index');
        }
		$catInfo->delete();
		$catInfo->cats()->delete();

        flash('删除成功')->success()->important();

        return redirect()->route('giftGoodCats.index');
    }

	/**
	 * 商品类别显示隐藏
	 * @author: colin
	 * @date: 2018/12/18 10:57
	 * @param $status
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function status($status,$id)
    {
    	$catInfo = $this->giftCatsService->ById($id);
        if(empty($catInfo))
        {
            flash('操作失败')->error()->important();

            return redirect()->route('giftGoodCats.index');
        }

		$catInfo->update(['status'=>$status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('giftGoodCats.index');
    }
}
