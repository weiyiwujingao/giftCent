<?php

namespace App\Http\Controllers\Api\Gift;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Gift\CheckCardRequest;
use App\Http\Requests\Api\Gift\AddRequest;
use App\Http\Requests\Api\Gift\GoodsRequest;
use App\Http\Requests\Api\Gift\GoodInfoRequest;
use App\Http\Requests\Api\Gift\SendSmsRequest;


class CardController extends Controller
{
    protected $request;
    protected $iationObj;
    protected $userInfo;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->Obj = new \Library\GiftCards($request);
    }

    /**
     * 检查卡
     * @author: colin
     * @date: 2018/12/25 10:07
     * @param CheckCardRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function checkCard(CheckCardRequest $request)
    {
        $result = $this->Obj->checkCard();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }

    /**
     * 登录
     * @author colin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $result = $this->Obj->list();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }

    /**
     * 判断是否是有效的登录token
     * @author colin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function isLogin()
    {
        $isLogin = $this->Obj->isLogin();
        if ($isLogin === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess('', '请求成功!');
    }

    /**
     * 激活
     * @author colin
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(AddRequest $request)
    {
        $result = $this->Obj->add();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result, '操作成功!');
    }

    /***
     * 获取套餐商品信息
     * @author: colin
     * @date: 2018/12/21 9:00
     * @param GoodsRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function goods(GoodsRequest $request)
    {
        $result = $this->Obj->goods();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }

    /***
     * 获取套餐商品信息
     * @author: colin
     * @date: 2018/12/21 9:00
     * @param GoodsRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function goodInfo(GoodInfoRequest $request)
    {
        $result = $this->Obj->goodInfo();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }

    /***
     * 订单信息
     * @author: colin
     * @date: 2018/12/21 9:00
     * @param GoodsRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function userOrder()
    {
        $result = $this->Obj->userOrder();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }

    /***
     * 快递详情查看
     * @author: colin
     * @date: 2018/11/19 11:33
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function expressDetail()
    {
        $expressDetail = $this->Obj->expressDetail();
        if ($expressDetail === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($expressDetail);
    }

    /**
     * 发送短信
     * @author: colin
     * @date: 2018/12/27 10:15
     * @param SendSmsRequest $SendSmsRequest
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function sendSms(SendSmsRequest $SendSmsRequest)
    {
        $result = $this->Obj->sendSms();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess();
    }

    /**
     * 验证手机号码是否存在订单
     * @author: colin
     * @date: 2018/12/27 10:15
     * @param SendSmsRequest $SendSmsRequest
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function checkModile(SendSmsRequest $SendSmsRequest)
    {
        $result = $this->Obj->checkModile();
        if ($result === false) {
            return self::showError($this->Obj->getUserMsg(), $this->Obj->getErrorNo());
        }
        return self::showSuccess($result);
    }
}
