<?php

namespace App\Services;

use App\Models\GiftCardType;
use App\Repositories\GiftGoodsRepository;
use App\Repositories\GiftGoodCatRepository;
use App\Repositories\GiftCardsRepository;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class GiftCardsService
{

    protected $giftGoodsRepository;

    protected $giftGoodCatRepository;

    protected $giftCardsRepository;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftGoodsRepository $giftGoodsRepository, GiftGoodCatRepository $giftGoodCatRepository, GiftCardsRepository $giftCardsRepository)
    {
        $this->giftGoodsRepository = $giftGoodsRepository;
        $this->giftGoodCatRepository = $giftGoodCatRepository;
        $this->giftCardsRepository = $giftCardsRepository;
    }

    /**
     * 获取商品列表 with ('cats')
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getCardList()
    {
		$where = $this->SearchArr();
    	$list = $this->giftCardsRepository->getCardList($where);
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
					case 'card_sn':
						$query -> where('card_sn', 'like', '%'.$value.'%');
						break;
					case 'cty_id':
						$query -> where('cty_id', $value);
						break;
					case 'status':
						if($value>=0){
							$query -> where('status', $value);
						}
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
        /*$startNum = GiftCardNum::where('id', 1)->value('number');
        if (empty($startNum)) {
            GiftCardNum::create(['id' => 1, 'number' => 1]);
            $startNum = 1;
        }*/
        $tmpSn = [];
        $n = $datas['id'] > 9999 ? strlen($datas['id']) : 4;
        $cardSnPre = sprintf("%0" . $n . "d", $datas['id']);
        for ($i = 0; $i < $datas['num']; $i++) {
            do {
                $cardSn = $cardSnPre . mt_rand(100000, 999999);
            } while (isset($tmpSn[$cardSn]));
            $cardPass = mt_rand(100000, 999999);
            $token = md5($datas['id'] . $cardSn . $cardPass);
            $startTime = strtotime($datas['start_time']);
            $endTime = strtotime($datas['end_time']);
            $dataInfo[] = [
                'cty_id'     => $datas['id'],
                'card_sn'    => $cardSn,
                'card_pass'  => $cardPass,
                'status'     => 0,
                'token'      => $token,
                'start_time' => $startTime,
                'end_time'   => $endTime,
            ];
            $tmpSn[$cardSn] = 1;
        }
        unset($tmpSn);
        DB::beginTransaction();
        try {
            $this->giftCardsRepository->insert($dataInfo);
            /*GiftCardNum::where('id', 1)->update(['number' => $startNum]);*/
            GiftCardType::where('id', $datas['id'])->increment('card_count', $datas['num']);
            DB::commit();
            $res = ['status' => 1];
        } catch (Exception $e) {
            DB::rollBack();
            $res = [
                'status'  => 0,
                'message' => $e->getMessage(),
            ];
        }
        return $res;
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

}