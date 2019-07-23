<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftOrderExpress extends Model
{
	protected $fillable = [
		'order_sn',
		'ex_id',
		'ex_num',
		'up_times',
		'create_time',
	];
	protected $table = 'gift_order_express';

	public $timestamps = false;

	protected $primaryKey = 'kid';

	protected $dateFormat = 'U';

	/**
	 * 物流公司信息
	 * @author: colin
	 * @date: 2018/12/21 14:33
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function exInfo()
	{
		return $this->hasOne(GiftExpressInfo::class,'ex_id','ex_id');
	}
	/**
	 * 物流
	 * @author: colin
	 * @date: 2018/12/21 14:33
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function exDetail()
	{
		return $this->hasOne(GiftExpressDetail::class,'order_sn','order_sn');
	}

}
