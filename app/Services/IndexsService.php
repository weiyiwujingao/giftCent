<?php

namespace App\Services;

use App\Repositories\GiftGoodsRepository;
use App\Repositories\GiftGroupRepository;
use App\Repositories\GiftOderRepository;
use Illuminate\Http\Request;
use DB;

class IndexsService
{

    protected $goodsRepository;

    protected $oderRepository;

    protected $groupRepository;

    /**
     * AdminsService constructor.
     * @param AdminsRepository $adminsRepository
     * @param ImageUploadHandler $imageUploadHandler
     * @param ActionLogsService $actionLogsService
     */
    public function __construct(GiftGoodsRepository $goodsRepository, GiftOderRepository $oderRepository,GiftGroupRepository $groupRepository)
    {
        $this->giftGoodsRepository = $goodsRepository;
        $this->oderRepository = $oderRepository;
        $this->giftGroupRepository = $groupRepository;
    }
	public function dataInfo()
	{
		try{
			$nowDay = date('Y-m-d',time());
			$dataInfo = [];
			$dataInfo['goodNum'] = $this->giftGoodsRepository->CountNum('id>0');
			$dataInfo['todayOrderNum'] = $this->oderRepository->CountNum("create_time>='{$nowDay}'");
			$dataInfo['preOrderNum'] = $this->oderRepository->CountNum("status=".\Enum\EnumKeys::OS_UNCONFIRMED);
			$dataInfo['userNum'] = count($this->oderRepository->GroupMobile());
			$dataInfo['gd_info'] = \Helper\CFunctionHelper::gdVersion();
			$mysqlV =  DB::selectOne("select version() as v;");
			$dataInfo['mysqlVersion'] =  $mysqlV->v;

		}catch (\Exception $e){
			echo $e->getMessage();
			return false;
		}
		return $dataInfo;
	}

}