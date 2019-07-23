<?php

namespace App\Services;

use App\Repositories\GiftGoodsRepository;
use App\Repositories\GiftGoodCatRepository;
use App\Repositories\GiftGroupRepository;
use App\Repositories\GiftCardTypeRepository as cardtype;
use Helper\CFunctionHelper as help;

class GiftGroupService
{

    protected $giftGoodsRepository;

    protected $giftGoodCatRepository;

    protected $giftGroupRepository;

    protected $cardtype;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftGroupRepository $giftGroupRepository, GiftGoodsRepository $giftGoodsRepository, GiftGoodCatRepository $giftGoodCatRepository, cardtype $cardtype)
    {
        $this->giftGoodsRepository = $giftGoodsRepository;
        $this->giftGoodCatRepository = $giftGoodCatRepository;
        $this->giftGroupRepository = $giftGroupRepository;
        $this->cardtype = $cardtype;
    }

    /**
     * 获取套餐列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGroupList()
    {
        $where = $this->SearchArr();
        $list = $this->giftGroupRepository->getGroupList($where);
        $list->appends(\Request::all())->links();
        foreach ($list as $k => $v) {
            $ids = explode(',', $v['gs_ids']);
            $goodlist = $this->giftGoodsRepository->getNameByIds($ids);
            $goodsnameArr = [];
            foreach ($goodlist as $value) {
                $goodsnameArr[] = $value;
            }
            $goodsname = implode(' + ', $goodsnameArr);
            $list[$k]['goodlist'] = $goodsname;
        }
        return $list;
    }

    /**
     * 简单搜索
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getListByName()
    {
        $where = $this->SearchArr();
        return $this->giftGroupRepository->getGroupList($where);
    }

    /**
     * 搜索条件
     * @author: colin
     * @date: 2018/12/24 12:07
     * @return \Closure
     */
    public function SearchArr()
    {
        $param = \Request::all();
        $where = function ($query) use ($param) {
            foreach ($param as $key => $value) {
                if (empty($value)) continue;
                switch ($key) {
                    case 'name':
                        $query->where('name', 'like', '%' . $value . '%');
                        break;
                    case 'gr_ids':
                        $query->whereIn('id', explode(',', $value));
                        break;
                    case 'status':
                        if ($value > 0) {
                            $query->where('status', $value);
                        }
                        break;
                    case 'start_time':
                        $query->where('create_time', '>=', $value);
                        break;
                    case 'end_time':
                        $query->where('create_time', '<=', $value);
                        break;
                    default:
                        break;

                }
            }
        };
        return $where;
    }

    /**
     * 获取指定ids的商品信息
     * @author: colin
     * @date: 2018/12/19 16:16
     * @param $request
     * @return array
     */
    public function goodsInfo($request)
    {
        $ids = trim($request->input('ids'), ',');
        $ids = explode(',', $ids);
        $goodlist = $this->giftGoodsRepository->ByIds($ids);
        $list = ['ids' => '', 'name' => '', 'price' => 0];
        foreach ($goodlist as $key => $value) {
            $list['ids'] .= ',' . $value->id;
            $list['name'] .= '+' . $value->name;
            $list['price'] = $list['price'] + $value->price;
        }
        $list['price'] = help::priceFormat($list['price'], true);
        $list['ids'] = trim($list['ids'], ',');
        $list['name'] = trim($list['name'], '+');
        return $list;
    }

    /**
     * 添加套餐
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        //dd($datas);
        if (is_array($datas['gs_ids'])) {
            $datas['gs_ids'] = implode(',', $datas['gs_ids']);
        }
        $dataInfo = [
            'name'   => $datas['name'],
            'price'  => $datas['price'],
            'gs_ids' => $datas['gs_ids'],
            'status' => $datas['status'],
        ];
        $admin = $this->giftGroupRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新套餐资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $dataInfo = $this->giftGroupRepository->ById($id);
        if (empty($dataInfo))
            return false;

        $dataInfo->update($datas);

        return $dataInfo;
    }

    /**
     * 获取套餐的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftGroupRepository->ById($id);
    }

    /**
     * 根据套餐id获取卡类型名称
     * @author: colin
     * @date: 2018/12/25 13:48
     * @param $id
     * @return mixed
     */
    public function getNameInsetById($id)
    {
        return $this->cardtype->getNameInsetById($id);;
    }
}