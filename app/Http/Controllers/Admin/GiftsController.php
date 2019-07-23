<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\AdminGiftRequest;
use App\Http\Requests\Admin\AdminGiftStoreRequest;
use Illuminate\Http\Request;
use App\Services\GiftCardsService;
use App\Services\GiftCompanyService;
use App\Services\GiftCardTypeService;
use App\Repositories\RolesRepository;
use App\Http\Requests\Admin\AdminLoginRequest;

class GiftsController extends BaseController
{
    protected $giftCardsService;
    protected $giftCompanyService;
    protected $giftCardTypeService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(GiftCardsService $giftCardsService, GiftCompanyService $giftCompanyService, GiftCardTypeService $giftCardTypeService)
    {
        $this->giftCardsService = $giftCardsService;
        $this->giftCompanyService = $giftCompanyService;
        $this->giftCardTypeService = $giftCardTypeService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $gifts = $this->giftCardsService->getCardList();
		$search = \Request::all();
        return $this->view(null, compact('gifts','search'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(AdminGiftRequest $request)
    {
        $id = $request->input('id');
        $info = $this->giftCardTypeService->ById($id);
        $company = $this->giftCompanyService->company();
        return view('admin.gifts.create', compact('info', 'company'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminGiftStoreRequest $request)
    {
        $res = $this->giftCardsService->create($request);
        if ($res['status'] == 1) {
            flash('添加礼品卡成功')->success()->important();
            return redirect()->route('giftCardType.index');
        } else {
            flash('添加失败：' . $res['message'])->error()->important();
            return redirect()->back();
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $admin = $this->giftCardsService->ById($id);

        $roles = $this->rolesRepository->getRoles();

        return view('admin.gifts.edit', compact('admin', 'roles'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, $id)
    {
        $this->giftCardsService->update($request, $id);

        flash('更新资料成功')->success()->important();

        return redirect()->route('gifts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $admin = $this->giftCardsService->ById($id);

        if (empty($admin)) {
            flash('删除失败')->error()->important();

            return redirect()->route('gifts.index');
        }


        $admin->roles()->detach();

        $admin->delete();


        flash('删除成功')->success()->important();

        return redirect()->route('gifts.index');
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status($status, $id)
    {
        $admin = $this->giftCardsService->ById($id);

        if (empty($admin)) {
            flash('操作失败')->error()->important();

            return redirect()->route('gifts.index');
        }

        $admin->update(['status' => $status]);

        flash('更新状态成功')->success()->important();

        return redirect()->route('gifts.index');
    }

}
