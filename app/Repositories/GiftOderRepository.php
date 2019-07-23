<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/13
 * Time: 上午9:54
 */
namespace App\Repositories;

use App\Models\GiftCardType;
use App\Models\GiftOrder;

class GiftOderRepository
{
    /**
     * 创建订单
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftOrder::create($params);
    }

    /**
     * 根据id获取订单资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return GiftOrder::find($id);
    }

    /**
     * 根据order_sn获取订单资料
     * @param $orderSn
     * @return mixed
     */
    public function ByOrderSn($orderSn)
    {
        return GiftOrder::where('order_sn', $orderSn)->first();
    }

    /**
     * 根据礼品卡id获取订单资料
     * @param $orderSn
     * @return mixed
     */
    public function ByCardId($cardId)
    {
        try {
            $orderInfo = GiftOrder::where('card_id', $cardId)->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
        return $orderInfo;
    }

    /**
     * 根据手机号码获取订单资料
     * @param $orderSn
     * @return mixed
     */
    public function ByMobileId($mobile)
    {
        try {
            $orderInfo = GiftOrder::where('user_mobile', $mobile)->orderBy('order_id', 'desc')->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
        return $orderInfo;

    }

    /**
     * 根据礼品卡id获取订单编号
     * @param $orderSn
     * @return mixed
     */
    public function getOrderSnCardId($cardId)
    {
        return GiftOrder::where('card_id', $cardId)->value('order_sn');
    }

    /**
     * 获取订单标号
     * @author: colin
     * @date: 2018/12/20 18:16
     */
    public function getOrderSn($orderSn)
    {
        return GiftOrder::where('order_sn', $orderSn)->value('order_sn');
    }

    /**
     * 根据id获取订单资料
     * @param $id
     * @return mixed
     */
    public function ByIdWithCard($id)
    {
        return GiftOrder::with('card')->find($id);
    }

    /**
     * 获取订单列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($where)
    {
        $perPage = intval(\Request::input('num')) > 0 ? intval(\Request::input('num')) : 10;
        $dataList = GiftOrder::where($where)->with('express')->latest('order_id')->paginate($perPage);
        foreach ($dataList as &$item) {
            if ($item->card && $item->card->cty_id) {
                $gData = GiftCardType::where('id', $item->card->cty_id)->first(['name', 'price']);
                $item->card->gname = !empty($gData) ? $gData->name : '';
                $item->card->gprice = !empty($gData) ? $gData->price : '';
            }
        }
        return $dataList;
    }

    /**
     * 根据ids获取信息
     * @param $ids
     * @return mixed
     */
    public function ByIds($ids)
    {
        return GiftOrder::whereIn('id', $ids)->get();
    }

    /**
     * 根据where条件统计数量
     * @author: colin
     * @date: 2018/12/28 10:36
     * @param $where
     */
    public function CountNum($where = [])
    {
        return GiftOrder::whereRaw($where)->count();
    }

    public function GroupMobile()
    {
        return GiftOrder::groupBy('user_mobile')->get();
    }

}