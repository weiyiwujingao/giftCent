<?php

namespace Library;

use DB;
use App;
use Enum\EnumKeys;
use App\Models\GiftCardType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use \Exception;
use Helper\CFunctionHelper as help;

class GiftCards extends CBase
{
    protected $request;
    protected $cardMd;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->cardMd = new App\Repositories\GiftCardsRepository();
        parent::__construct(__CLASS__);
    }

    /**
     * 获取卡token
     * @author colin
     * @param array $loginInfo 基本用户信息
     * @return array|type
     */
    public function checkCard()
    {
        $loginInfo = $this->request->all();
        $numkey = md5('check_card_time_' . $loginInfo['card_sn']);
        $checkNum = intval(cache::get($numkey));
        try {
            if ($checkNum >= EnumKeys::CHECK_TRY_NUMS) {
                $this->cardMd->UpCardSn($loginInfo['card_sn'], ['status' => 3, 'remark' => '连续3次以上，输入错误密码，暂时冻结卡']);
                throw new Exception('该券已锁定，请联系客服！');
            }
            $cardInfo = $this->cardMd->getInfo($loginInfo['card_sn'], $loginInfo['card_pass']);//获取卡信息
            if ($cardInfo === false) {
                $checkNum++;
                Cache::put($numkey, $checkNum, 6000);
                throw new Exception('券号或密码错误，请检查！');
            }
            $cardInfo = $cardInfo->toArray();
            if (!empty($cardInfo)) {
                if ($cardInfo['status'] == 2) {
                    throw new Exception('该券已过期！');
                }
                if ($cardInfo['status'] == 3) {
                    throw new Exception('该券已锁定，请联系客服！');
                }
                if ($cardInfo['card_type']['status'] == 0) {
                    throw new Exception('该券暂时无法使用，请联系客服！');
                }
                $dataCache = [
                    "card_sn"          => $cardInfo['card_sn'],
                    "card_id"          => $cardInfo['id'],
                    "status"           => $cardInfo['status'],
                    "card_type_name"   => $cardInfo['card_type']['name'],
                    "card_type_id"     => $cardInfo['card_type']['id'],
                    "card_type_price"  => $cardInfo['card_type']['price'],
                    "card_type_status" => $cardInfo['card_type']['status'],
                    "ctime"            => time(),
                ];
                $token = 'gift_token' . $cardInfo['token'];
                $expiresAt = 60 * 24 * 10;
                Cache::put($token, $dataCache, $expiresAt);
                $result = [
                    'token'  => $cardInfo['token'],
                    'status' => $cardInfo['status'],
                ];
                return $result;
            }

        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "login get user fail.loginInfo:" . json_encode($loginInfo) . ",reason:" . $e->getMessage(),
                'userMsg'  => $e->getMessage(),
                'line'     => __LINE__,
            ]);
        }
        return false;
    }

    /**
     * 判断是否登录
     * @param $param
     * @return mixed
     * @author colin
     */
    public function isLogin()
    {
        try {
            if (empty($this->request->input('card_sn'))) {
                throw new Exception('未登录！');
            }
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_LOGIN_NO,
                'errorMsg' => "islogin fail reason:" . $e->getMessage(),
                'userMsg'  => '未登录！',
                'line'     => __LINE__,
            ]);
        }
        return true;
    }

    /**
     * 卡套餐信息
     * @author colin
     * @param array $loginInfo 基本用户信息
     * @return array|type
     */
    public function list()
    {
        $param = $this->request->all();
        $groupMd = new App\Repositories\GiftGroupRepository();
        $goodMd = new App\Repositories\GiftGoodsRepository();
        try {
            $cardInfo = $this->cardMd->ByCardSn($param['card_sn'])->toArray();//获取卡信息
            $grIds = explode(',', $cardInfo['card_type']['gr_ids']);
            $groupInfo = $groupMd->ByIds($grIds);//获取套餐信息
            foreach ($groupInfo as $k => $v) {
                $goodIds = explode(',', $v->gs_ids);
                $groupInfo[$k]['goodInfo'] = $goodMd->ByIds($goodIds)->toArray();
            }
            $groupInfo = $groupInfo->toArray();
            $cardInfo['groupList'] = $groupInfo;
            $dataInfo = self::setCardData($cardInfo);
            return $dataInfo;

        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "list get cardmsg fail.list:" . json_encode($param) . ",reason:" . $e->getMessage(),
                'userMsg'  => '获取卡信息失败！',
                'line'     => __LINE__,
            ]);
        }
        return false;
    }

    /**
     * 获取套餐信息
     * @author: colin
     * @date: 2018/12/21 9:16
     * @return bool|type
     */
    public function goods()
    {
        $id = $this->request->input('id');
        $groupMd = new App\Repositories\GiftGroupRepository();
        $goodMd = new App\Repositories\GiftGoodsRepository();
        try {
            $groupInfo = $groupMd->ById($id)->toArray();//获取套餐信息
            $goodIds = explode(',', $groupInfo['gs_ids']);
            $goodlist = $goodMd->ByIds($goodIds)->toArray();
            foreach ($goodlist as $key => $value) {
                $goodlist[$key]['cat_name'] = $value['cats']['name'];
                unset($goodlist[$key]['cats']);
            }
            return $goodlist;
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "get goods fail:" . json_encode($id) . ",reason:" . $e->getMessage(),
                'userMsg'  => '获取套餐商品失败！',
                'line'     => __LINE__,
            ]);
        }
        return false;
    }

    /**
     * 获取商品信息
     * @author: colin
     * @date: 2018/12/21 9:16
     * @return bool|type
     */
    public function goodInfo()
    {
        $id = $this->request->input('id');
        $goodMd = new App\Repositories\GiftGoodsRepository();
        try {
            $goodInfo = $goodMd->ByIdWithCats($id)->toArray();
            $goodInfo['content'] = $this->fiterContent($goodInfo['content']);
            $data = [
                'name'     => $goodInfo['name'],
                'imgs'     => $goodInfo['imgs'],
                'price'    => help::priceFormat($goodInfo['price']),
                'content'  => $goodInfo['content'],
                'cat_name' => $goodInfo['cats']['name'],
            ];
            return $data;
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "get goodInfo fail:" . json_encode($id) . ",reason:" . $e->getMessage(),
                'userMsg'  => '获取商品信息失败！',
                'line'     => __LINE__,
            ]);
        }
        return false;
    }

    /**
     * 商品详情内容处理
     * @author: colin
     * @date: 2018/12/25 15:50
     * @param $content
     */
    public function fiterContent($content)
    {
        //匹配图片更换图片地址
        $content = preg_replace_callback("@<img src=\"(\/.*?)\"(.*?)@", function ($contentImgArr) {
            if (isset($contentImgArr[1]) && !empty($contentImgArr[1])) {
                $mainUrl = config('app.static_host');
                $imageLink = $mainUrl . $contentImgArr[1];
                if (!empty($imageLink)) {
                    return '<img src="' . $imageLink . '" ';
                }
            }
        }, $content);
        return $content;
    }

    /**
     * 激活卡
     * @author: colin
     * @date: 2018/12/20 17:01
     * @return bool|type
     */
    public function add()
    {
        \DB::beginTransaction();
        try {
            $param = $this->request->all();
            $cardSn = $this->request->input('card_sn');
            $cardInfo = $this->cardMd->ByCardSn($cardSn)->toArray();//获取卡信息
            $check = self::checkAdd($param, $cardInfo);
            if ($check == false) {
                \DB::rollBack();
                return false;
            }
            $cardData = [
                'use_time' => date('Y-m-d H:i:s'),
                'status'   => 1,
            ];
            $re = $this->cardMd->UpCardSn($cardSn, $cardData);
            if ($re === false) {
                throw new Exception('卡信息更新有误！');
            }
            $orderMd = new App\Repositories\GiftOderRepository();
            $code = $this->request->input('code', '');

            if ($code) {
                $key = 'mobile_Code_gift' . $param['user_mobile'];
                $cacheCode = Cache::get($key);
                if (empty($cacheCode) || $cacheCode != $code) {
                    throw new Exception('验证码错误！');
                }
                Cache::put($key, '', 1);
            } else {
                $userInfo = $orderMd->ByMobileId($param['user_mobile']);
                if ($userInfo === false) {
                    throw new Exception('请输入验证码！');
                }
            }
            //初始化订单表
            $order = [
                'card_id'          => $cardInfo['id'],
                'sel_gr_id'        => $param['group_id'],
                'status'           => EnumKeys::OS_UNCONFIRMED,
                'user_name'        => $param['user_name'],
                'user_name'        => $param['user_name'],
                'user_mobile'      => $param['user_mobile'],
                'user_address'     => $param['user_address'],
                'user_address_all' => $param['user_address_all'],
                'remark'           => !empty($param['remark']) ? $param['remark'] : '',
            ];
            /* 插入订单表 */
            do {
                $order['order_sn'] = help::getOrderSn(); //获取新订单号
                $orderSn = $orderMd->getOrderSn($order['order_sn']);
            } while (!empty($orderSn)); //如果是订单号重复则重新提交数据
            $orderMd->create($order);
            GiftCardType::where('id', $cardInfo['cty_id'])->increment('use_count', 1);
        } catch (\Exception $e) {
            \DB::rollBack();
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "add 激活卡 fail reason:" . $e->getMessage(),
                'userMsg'  => $e->getMessage(),
                'line'     => __LINE__,
            ]);
        }
        \DB::commit();
        return true;
    }

    /***
     * 用户订单信息
     * @author: colin
     * @date: 2018/12/21 10:14
     * @return type
     */
    public function userOrder()
    {
        try {
            $param = $this->request->all();
            $cardId = $param['card_id'];
            $cacheKey = 'userOrder' . $cardId;
            $orderInfoJson = cache()->get($cacheKey);
            if (!empty($orderInfoJson)) {
                return json_decode($orderInfoJson, true);
            }
            $orderMd = new App\Repositories\GiftOderRepository();
            $groupMd = new App\Repositories\GiftGroupRepository();
            $goodMd = new App\Repositories\GiftGoodsRepository();
            $cardObj = new App\Repositories\GiftCardsRepository();
            $cardTypeObj = new App\Repositories\GiftCardTypeRepository();
            $orderInfo = $orderMd->ByCardId($cardId);//获取订单信息
            if ($orderInfo === false) {
                throw new Exception('暂无订单信息！');
            }
            $groupId = $orderInfo->sel_gr_id;//获取套餐id
            if (empty($groupId)) {
                throw new Exception('暂无选定的套餐');
            }
            $groupInfo = $groupMd->ById($groupId);//获取套餐信息
            $goodIds = explode(',', $groupInfo->gs_ids);
            $groupInfo['goodInfo'] = $goodMd->ByIds($goodIds)->toArray();
            $groupInfo = $groupInfo->toArray();
            $cardInfo = $cardObj->ById($cardId);
            $cardType = $cardTypeObj->ById($cardInfo->cty_id);
            $groupInfo['price'] = $cardType->price;
            $groupInfo['card_sn'] = $cardInfo->card_sn;
            $orderInfo = self::setOrderData($orderInfo, $groupInfo, $param['cardInfo']['card_type_price']);
            if ($orderInfo === false) {
                throw new Exception('暂无订单信息！');
            }
            cache()->set($cacheKey, json_encode($orderInfo), 10);
        } catch (\Exception $e) {

            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "userOrder 获取订单信息 fail reason:" . $e->getMessage(),
                'userMsg'  => '获取订单信息失败！',
                'line'     => __LINE__,
            ]);
        }
        return $orderInfo;
    }

    /**
     * 物流详情
     * @author: colin
     * @date: 2018/12/26 16:46
     * @return array|type
     */
    public function expressDetail()
    {
        try {
            $param = $this->request->all();
            $cardId = $param['card_id'];
            $orderMd = new App\Repositories\GiftOderRepository();
            $ExorderMd = new App\Repositories\GiftOderExpressRepository();
            $orderSn = $orderMd->getOrderSnCardId($cardId);//获取订单信息
            if (empty($orderSn)) {
                throw new \Exception('暂无订单！');
            }
            $orderExp = $ExorderMd->ByOrderSn($orderSn);
            if (empty($orderExp)) {
                throw new \Exception('订单暂无物流信息！');
            }
            $orderExp = $orderExp->toArray();
            $result = [
                'ex_num'  => $orderExp['ex_num'],
                'ex_name' => $orderExp['ex_info']['ex_name'],
                'ex_tel'  => $orderExp['ex_info']['ex_tel'],
                'list'    => [],
            ];
            $exMess = \App\Models\GiftExpressDetail::where(['order_sn' => $orderSn, 'ex_num' => $orderExp['ex_num']])->value('ex_cnt');
            if (!empty($exMess)) {
                $result['ischeck'] = '1';
                $result['list'] = unserialize($exMess);
                return $result;
            }
            $dataArr = help::kuaidicx($orderExp['ex_info']['ex_sn'], $orderExp['ex_num']);
            if ($dataArr['status'] == 1 && !empty($dataArr['data']['list'])) {
                $result['state'] = $dataArr['data']['state'];
                $result['ischeck'] = $dataArr['data']['ischeck'];
                $result['list'] = $dataArr['data']['list'];
                if ($result['ischeck'] == 1) {//保存
                    $dataInfo = [
                        'order_sn' => $orderSn,
                        'ex_num'   => $orderExp['ex_num'],
                        'ex_cnt'   => serialize($dataArr['data']['list']),
                    ];
                    \App\Models\GiftExpressDetail::updateOrcreate(['order_sn' => $orderSn], $dataInfo);
                }
            } else {
                return $this->setErrorAndReturn([
                    'return'   => false,
                    'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                    'errorMsg' => "expressDetail 查看物流信息失败 fail.orderSn:{$orderSn},reason:" . $dataArr['message'],
                    'userMsg'  => $dataArr['message'],
                    'line'     => __LINE__,
                ]);
            }

        } catch (\Exception  $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "expressDetail 查看物流信息失败 fail.orderSn:{$orderSn},reason:" . $e->getMessage(),
                'userMsg'  => '暂无物流信息',
                'line'     => __LINE__,
            ]);
        }
        return $result;
    }

    /***
     * 礼品卡发送短信
     * @author: colin
     * @date: 2018/12/3 10:37
     * @return bool|type
     */
    public function sendSms()
    {
        $mobile = $this->request->input('mobile');
        try {
            $mobileCode = mt_rand(111111, 999999);
            $sendFlag = help::sendMobileSmsCode($mobile, $mobileCode, 0);
            if ($sendFlag === false) {
                throw new Exception('短信发送失败');
            }
            $key = 'mobile_Code_gift' . $mobile;
            Cache::put($key, $mobileCode, 10);
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => $e->getMessage(),
                'userMsg'  => $e->getMessage(),
                'line'     => __LINE__,
            ]);
        }
        return true;
    }

    /***
     * 检查是否第一次使用
     * @author: colin
     * @date: 2018/12/3 10:37
     * @return bool|type
     */
    public function checkModile()
    {
        $mobile = $this->request->input('mobile');
        $result = ['userInfo' => ''];
        try {
            $orderMd = new App\Repositories\GiftOderRepository();
            $userInfo = $orderMd->ByMobileId($mobile);
            if ($userInfo === false) {
                return $result;
            }
            $result['userInfo'] = [
                'user_name'        => $userInfo->user_name,
                'user_mobile'      => $userInfo->user_mobile,
                'user_address'     => $userInfo->user_address,
                'user_address_all' => $userInfo->user_address_all,
            ];
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => $e->getMessage(),
                'userMsg'  => $e->getMessage(),
                'line'     => __LINE__,
            ]);
        }
        return $result;
    }

    /***
     * 组装订单信息
     * @author: colin
     * @date: 2018/12/21 10:28
     * @param $orderInfo
     * @param $param
     * @return type
     */
    private function setOrderData($orderInfo, $groupInfo, $price)
    {
        try {
            $orderInfo = $orderInfo->toArray();
            $orderInfo['group_name'] = $groupInfo['name'];
            $orderInfo['group_price'] = help::priceFormat($price);
            $orderInfo['card_sn'] = $groupInfo['card_sn'];
            foreach ($groupInfo['goodInfo'] as $k => $v) {
                $orderInfo['good_list'][] = [
                    'id'       => $v['id'],
                    'name'     => $v['name'],
                    'price'    => help::priceFormat($v['price']),
                    'imgs'     => $v['imgs'],
                    'cat_name' => $v['cats']['name'],
                ];
            }
            unset($orderInfo['order_id'], $orderInfo['card_id']);
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "userOrder 获取订单信息 fail reason:" . $e->getMessage(),
                'userMsg'  => '组装订单信息失败！',
                'line'     => __LINE__,
            ]);
        }
        return $orderInfo;
    }

    /**
     * 检测激活信息是否合法
     * @author: colin
     * @date: 2018/12/20 18:30
     */
    private function checkAdd($param, $cardInfo)
    {
        try {
            $nowtime = time();
            if ($cardInfo['status'] != 0) {
                $msg = '该礼品券' . (($cardInfo['status'] == 1) ? '已使用' : '已过期');
                throw new Exception($msg);
            }
            $grIds = explode(',', $cardInfo['card_type']['gr_ids']);
            if (!in_array($param['group_id'], $grIds)) {
                throw new Exception('套餐选择有误，请检查！');
            }
            if (!($nowtime > $cardInfo['start_time'] && $nowtime < $cardInfo['end_time'])) {
                throw new Exception('请在有效期内使用！');
            }
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "add 激活卡 fail reason:" . $e->getMessage(),
                'userMsg'  => $e->getMessage(),
                'line'     => __LINE__,
            ]);
        }
        return true;
    }

    /**
     * 组装卡信息数据
     * @author: colin
     * @date: 2018/12/20 15:02
     * @param $data
     */
    private function setCardData($data)
    {
        try {
            $group = [];
            foreach ($data['groupList'] as $v) {
                $goodInfo = [];
                foreach ($v['goodInfo'] as $key => $item) {
                    $goodInfo[$key] = [
                        'id'    => $item['id'],
                        'name'  => $item['name'],
                        'price' => help::priceFormat($item['price']),
                        'imgs'  => $item['imgs'],
//						'content' => $item['content'],
//						'cat_name' => $item['cats']['name'],
//						'cat_id' => $item['cats']['id'],
                    ];
                }
                $group[] = [
                    "id"          => $v['id'],
                    "name"        => $v['name'],
                    "price"       => help::priceFormat($item['price']),
                    "create_time" => $v['create_time'],
                    "goodInfo"    => $goodInfo,
                ];

            }
            $result = [
                "card_sn"        => $data['card_sn'],
                "status"         => $data['status'],
                "card_type_name" => $data['card_type']['name'],
                "price"          => $data['card_type']['price'],
                "groupList"      => $group,
                "start_time"     => date('Y-m-d H:i:s', $data['start_time']),
                "end_time"       => date('Y-m-d H:i:s', $data['end_time']),
                "use_time"       => $data['use_time'],
                "create_time"    => $data['create_time'],
            ];
        } catch (\Exception $e) {
            return $this->setErrorAndReturn([
                'return'   => false,
                'code'     => \Enum\EnumMain::HTTP_CODE_FAIL,
                'errorMsg' => "login fail setCardData reason:" . $e->getMessage(),
                'userMsg'  => '数据组装出错',
                'line'     => __LINE__,
            ]);
        }
        return $result;
    }

}