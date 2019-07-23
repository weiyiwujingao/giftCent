<?php

namespace App\Services;

use DB;
use App\Repositories\GiftCardTypeRepository;
use App\Repositories\GiftGroupRepository;
use App\Repositories\GiftCardsRepository as cardRe;
use Helper\CFunctionHelper as help;


class GiftCardTypeService
{

    protected $giftCardTypeRepository;

    protected $giftGroupRepository;

    protected $cardRe;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftCardTypeRepository $giftCardTypeRepository, GiftGroupRepository $giftGroupRepository, cardRe $cardRe)
    {
        $this->giftCardTypeRepository = $giftCardTypeRepository;
        $this->giftGroupRepository = $giftGroupRepository;
        $this->cardRe = $cardRe;
    }

    /**
     * 获取礼品卡列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList()
    {
        $where = $this->SearchArr();
        $list = $this->giftCardTypeRepository->getList($where);
        $list->appends(\Request::all())->links();
        foreach ($list as $k => $v) {
            $ids = explode(',', $v['gr_ids']);
            $grouplist = $this->giftGroupRepository->getNameByIds($ids);
            $names = [];
            foreach ($grouplist as $value) {
                $names [] = $value;
            }
            $list[$k]['grouplist'] = implode('+', $names);
        }
        return $list;
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
     * 获取指定ids的礼品卡信息
     * @author: colin
     * @date: 2018/12/19 16:16
     * @param $request
     * @return array
     */
    public function groupInfo($request)
    {
        $ids = trim($request->input('ids'), ',');
        $ids = explode(',', $ids);
        $grouplist = $this->giftGroupRepository->ByIds($ids);
        $list = ['ids' => [], 'name' => [], 'price' => 0];
        foreach ($grouplist as $key => $value) {
            $list['ids'][] = $value->id;
            $list['name'][] = $value->name;
            $list['price'] = $list['price'] + $value->price;
        }
        $list['price'] = help::priceFormat($list['price'], true);
        $list['ids'] = implode(',', $list['ids']);
        $list['name'] = implode('+', $list['name']);
        return $list;
    }

    /**
     * 添加礼品卡
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        if (is_array($datas['gr_ids'])) {
            $datas['gr_ids'] = implode(',', $datas['gr_ids']);
        }
        //dd($datas);
        $dataInfo = [
            'name'       => $datas['name'],
            'price'      => $datas['price'],
            'gr_ids'     => $datas['gr_ids'],
            'company_id' => $datas['company_id'],
            'start_time' => strtotime($datas['start_time']),
            'end_time'   => strtotime($datas['end_time'] . '23:59:59'),
            //'is_online' => $datas['is_online'],
        ];
        $admin = $this->giftCardTypeRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新礼品卡资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $good = $this->giftCardTypeRepository->ById($id);
        if (empty($good))
            return false;

        $good->update($datas);

        return $good;
    }

    /**
     * 获取礼品卡的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftCardTypeRepository->ById($id);
    }

    /**
     * 线下幸福卡表格数据
     * @author: colin
     * @date: 2018/12/26 14:27
     * @return array|bool
     */
    public function explodeData()
    {
        $ctyId = \Request::input('id');
        $cardList = $this->cardRe->ByctyId($ctyId)->toArray();
        if (empty($cardList))
            return false;
        $data = [];
        $titles = [
            'card_sn'   => '卡号',
            'card_pass' => '密码',
            'content'   => '充值二维码密码',
            'price'     => '礼品卡金额',
            'name'      => '类型名称',
            'end_time'  => '使用结束日期',
        ];
        foreach ($cardList as $key => $value) {
            foreach ($titles as $k => $v) {
                switch ($k) {
                    case 'content':
                        $data[$k][] = 'YXFL|' . $value['card_sn'] . '|' . $value['card_pass'];
                        break;
                    case 'name':
                        $data[$k][] = $value['card_type']['name'];
                        break;
                    case 'price':
                        $data[$k][] = $value['card_type']['price'];
                        break;
                    case 'end_time':
                        $data[$k][] = date('Y-m-d', $value['end_time']);
                        break;
                    default:
                        $data[$k][] = $value[$k];
                        break;
                }
            }
        }
        $result = [
            'data'   => $data,
            'titles' => $titles,
        ];
        return $result;
    }
}