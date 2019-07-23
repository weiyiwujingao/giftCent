<?php

namespace App\Services;

use App\Repositories\GiftOderExpressRepository;
use App\Repositories\GiftOderRepository as GiftOder;

use Illuminate\Http\Request;

class ExpressService
{

    protected $giftOderExpressRepository;
    protected $giftOder;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftOderExpressRepository $giftOderExpressRepository, GiftOder $giftOder)
    {
        $this->giftOderExpressRepository = $giftOderExpressRepository;
        $this->giftOder = $giftOder;
    }
    /**
     * 获取物流列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list()
    {
		//搜索条件
		$where  = $this->SearchArr();
        $list = $this->giftOderExpressRepository->list($where);
		$list->appends(\Request::all())->links();
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
		$where = function ($query) use($param){
			foreach ($param as $key=>$value){
				if(empty($value)) continue;
				switch($key){
					case 'ex_num':
						$query -> where('ex_num', 'like', '%'.$value.'%');
						break;
					case 'order_sn':
						$query -> where('order_sn', 'like', '%'.$value.'%');
						break;
					case 'start_time':
						$query -> where('create_time', '>=', $value);
						break;
					case 'end_time':
						$query -> where('create_time', '<=', $value. ' 23:59:59');
						break;
					default:
						break;

				}
			}
		};
		return $where;
	}
    /**
     * 添加物流
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $datas = $request->all();
        $dataInfo = [
            'order_sn'    => $datas['order_sn'],
            'ex_id'   => $datas['ex_id'],
            'ex_num'  => $datas['ex_num'],
        ];
        $admin = $this->giftOderExpressRepository->create($dataInfo);
        return $admin;
    }

    /**
     * 更新物流资料
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $datas = $request->all();
        $orderExpress = $this->giftOderExpressRepository->ById($id);
        if (empty($orderExpress))
            return false;

		$orderExpress->update($datas);

        return $orderExpress;
    }

    /**
     * 获取物流的详细资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->giftOderExpressRepository->ById($id);
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
			$param = \Request::all();
			$orderSn = $param['order_sn'];
			$ExorderMd = $this->giftOderExpressRepository;
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
			$dataArr = \Helper\CFunctionHelper::kuaidicx($orderExp['ex_info']['ex_sn'], $orderExp['ex_num']);
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
				return false;
			}

		} catch (\Exception  $e) {
			return false;
		}
		return $result;
	}

}