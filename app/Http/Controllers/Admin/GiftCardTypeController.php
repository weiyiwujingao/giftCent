<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests\Admin\AdminCardTypeRequest;
use App\Http\Requests\Admin\AdminCardTypeStoreRequest;
use App\Http\Requests\Admin\AdminCardExplodeRequest;
use Illuminate\Http\Request;
use App\Services\GiftCardTypeService;
use App\Services\GiftCompanyService;
use App\Repositories\RolesRepository;
use App\Repositories\GiftCompanyRepository;

class GiftCardTypeController extends BaseController
{
    protected $giftCardTypeService;
    protected $giftCompanyService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     * @param RolesRepository $rolesRepository
     */
    public function __construct(GiftCardTypeService $giftCardTypeService, GiftCompanyService $giftCompanyService)
    {
        $this->giftCardTypeService = $giftCardTypeService;
        $this->giftCompanyService = $giftCompanyService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->giftCardTypeService->getList();
        $search = \Request::all();
        return $this->view(null, compact('list', 'search'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $typeInfo = [];//$this->giftCardTypeService->groupInfo($request);
        $typeInfo['company_list'] = \App::make(GiftCompanyRepository::class)->company();
        return view('admin.giftCardType.create', compact('typeInfo'));
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCardTypeStoreRequest $request)
    {
        $this->giftCardTypeService->create($request);
        flash('添加礼品卡类型成功')->success()->important();
        return redirect()->route('giftCardType.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $info = $this->giftCardTypeService->ById($id);
        $info['company_list'] = \App::make(GiftCompanyRepository::class)->company();
        return view('admin.giftCardType.edit', compact('info'));
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminCardTypeStoreRequest $request, $id)
    {
        $this->giftCardTypeService->update($request, $id);
        flash('更新资料成功')->success()->important();
        return redirect()->route('giftCardType.index');
    }

    /**
     * 添加礼品卡页面
     * @author: colin
     * @date: 2018/12/19 18:19
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function push($id)
    {
        $info = $this->giftCardTypeService->ById($id);
        $company = $this->giftCompanyService->company();
        return view('admin.giftCardType.push', compact('info', 'company'));
    }

    /**
     * 导出幸福卡表格信息
     * @author: colin
     * @date: 2018/12/26 14:25
     * @param AdminCardExplodeRequest $request
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function explodeData(AdminCardExplodeRequest $request)
    {
        $result = $this->giftCardTypeService->explodeData();
        if ($result === false) {
            flash('不存在卡！')->error()->important();
            return redirect()->back();
        }
        ini_set('memory_limit', '500M');
        \Helper\OfiiceHelper::exportExcelOne($result['titles'], $result['data'], '线下发放礼品卡', '线下礼品卡信息列表');
    }

}
