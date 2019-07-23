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

use App\Models\GiftCard;

class GiftCardsRepository
{
    /**
     * 创建礼品卡
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return GiftCard::create($params);
    }

    /**
     * 创建礼品卡
     * @param array $params
     * @return mixed
     */
    public function insert(array $params)
    {
        return GiftCard::insert($params);
    }

    /**
     * 根据id获取礼品卡资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return GiftCard::find($id);
    }

    /**
     * 根据卡号获取礼品卡资料
     * @param $cardSn
     * @return mixed
     */
    public function ByCardSn($cardSn)
    {
        try {
            $info = GiftCard::with('cardType')->where('card_sn', $cardSn)->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
        return $info;

    }

    /**
     * 根据卡号更新卡信息
     * @param $cardSn
     * @return mixed
     */
    public function UpCardSn($cardSn, $data)
    {
        try {
            GiftCard::where('card_sn', $cardSn)->update($data);
        } catch (\Exception $e) {
            return false;
        }
        return true;

    }

    /**
     * 根据id获取礼品卡名称
     * @param $id
     * @return mixed
     */
    public function getNameByIds($ids)
    {
        return GiftCard::whereIn('id', $ids)->pluck('name');
    }

    /**
     * 根据id获取礼品卡选择的套餐id
     * @param $id
     * @return mixed
     */
    public function getSelectIdById($id)
    {
        return GiftCard::where('id', $id)->value('select_card_id');
    }

    /**
     * 根据id获取礼品卡资料
     * @param $id
     * @return mixed
     */
    public function ByIds($ids)
    {
        return GiftCard::whereIn('id', $ids)->get();
    }

    /**
     * 根据id获取礼品卡资料
     * @param $id
     * @return mixed
     */
    public function ByIdWithCats($id)
    {
        return GiftCard::with('cats')->find($id);
    }

    /**
     * 获取礼品卡列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCardList($where)
    {
        $perPage = intval(\Request::input('num')) > 0 ? intval(\Request::input('num')) : 15;
        return GiftCard::where($where)->with('cardType')->latest('id')->paginate($perPage);
    }

    /**
     * 获取礼品卡列表 with ('roles')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function CardList()
    {
        return GiftCard::with('cardType')->latest('id')->paginate('10');
    }

    /**
     * 根据name查询礼品卡资料
     * @param $name
     * @return mixed
     */
    public function ByName($name)
    {
        return GiftCard::where('name', $name)->first();
    }

    /**
     * 根据卡号和密码获取卡信息
     * @author: colin
     * @date: 2018/12/20 14:08
     * @param $cardSn
     * @param $cardpass
     * @return bool|\Illuminate\Database\Eloquent\Model|static
     */
    public function getInfo($cardSn, $cardpass)
    {
        try {
            $cardInfo = GiftCard::with('cardType')->select('id', 'cty_id', 'card_sn', 'status', 'token', 'start_time', 'end_time', 'use_time', 'create_time')
                ->where('card_sn', $cardSn)
                ->where('card_pass', $cardpass)
                ->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
        return $cardInfo;
    }

    /**
     * 根据卡类型id获取礼品卡信息
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function ByctyId($ctyId)
    {
        return GiftCard::with('cardType')->where('cty_id', $ctyId)->get();
    }
}