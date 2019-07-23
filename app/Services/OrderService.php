<?php

namespace App\Services;

use App\Repositories\GiftOderRepository;

class OrderService
{
    protected $giftOderRepository;

    /**
     * OrderService constructor.
     * @param GiftOderRepository $giftOderRepository
     */
    public function __construct(GiftOderRepository $giftOderRepository)
    {
        $this->giftOderRepository = $giftOderRepository;
    }

    /**
     * 获取订单列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrderList()
    {
        //搜索条件
        $where = $this->SearchArr();
        $order = $this->giftOderRepository->getList($where);
        $order->appends(\Request::all())->links();
        return $order;
    }

    /**
     * 获取所有订单状态
     * @return array
     */
    public function getAllStatus()
    {
        return [
            0 => '未发货',
            1 => '已发货',
            2 => '已确认',
            3 => '已取消',
        ];
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
                if ($key == 'status') {
                    $value++;
                }
                if (empty($value)) {
                    continue;
                }
                switch ($key) {
                    case 'order_sn':
                        $query->where('order_sn', 'like', '%' . $value . '%');
                        break;
                    case 'user_mobile':
                        $query->where('user_mobile', 'like', '%' . $value . '%');
                        break;
                    case 'status':
                        $value = intval($value);
                        $value--;
                        $query->where('status', $value);
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

    public function ById($id)
    {
        return $this->giftOderRepository->ById($id);
    }

}