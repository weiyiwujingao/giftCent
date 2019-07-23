<?php

namespace App\Services;

use App\Repositories\GiftGoodsRepository;
use App\Repositories\GiftGoodCatRepository;
use App\Repositories\GiftGroupRepository;
use Illuminate\Http\Request;

class GiftService
{

    protected $giftGoodsRepository;

    protected $giftGoodCatRepository;

    protected $giftGroupRepository;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftGoodsRepository $giftGoodsRepository, GiftGoodCatRepository $giftGoodCatRepository, GiftGroupRepository $giftGroupRepository)
    {
        $this->giftGoodsRepository = $giftGoodsRepository;
        $this->giftGoodCatRepository = $giftGoodCatRepository;
        $this->giftGroupRepository = $giftGroupRepository;
    }

    /**
     * 获取商品列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGoodsWithCats()
    {
        //搜索条件
        $where = $this->SearchArr();
        $good = $this->giftGoodsRepository->getGoodsWithCats($where);
        $good->appends(\Request::all())->links();
        return $good;
    }

    /**
     * @return mixed
     */
    public function getGoodsListByName()
    {
        $where = $this->SearchArr();
        $dataList = $this->giftGoodsRepository->getGoodsListByName($where);
        return $dataList;
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
                    case 'card_sn':
                        $query->where('card_sn', 'like', '%' . $value . '%');
                        break;
                    case 'gs_ids':
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
                        $query->where('create_time', '<=', $value . ' 23:59:59');
                        break;
                    default:
                        break;

                }
            }
        };
        return $where;
    }

    /**
     * 获取商品列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getGoods($request)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return false;
        }
        return $this->giftGoodsRepository->getGoods($ids);
    }

    /**
     * 获取商品列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCats()
    {
        return $this->giftGoodCatRepository->getCats();
    }

    /**
     * 添加商品
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        $dataInfo = [
            'name'    => $datas['name'],
            'price'   => $datas['price'],
            'cat_id'  => $datas['cat_id'],
            'status'  => $datas['status'],
            'imgs'    => $datas['imgs'],
            'content' => $datas['content'],
        ];
        $admin = $this->giftGoodsRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新商品资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $good = $this->giftGoodsRepository->ById($id);
        if (empty($good))
            return false;

        $good->update($datas);

        return $good;
    }

    /**
     * 获取商品的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftGoodsRepository->ById($id);
    }

    /**
     * 通过商品id获取套餐
     * @author: colin
     * @date: 2018/12/25 11:56
     * @param $id
     * @return mixed
     */
    public function InsetById($id)
    {
        return $this->giftGroupRepository->InsetById($id);
    }

}