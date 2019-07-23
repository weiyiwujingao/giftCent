<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftCard extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = [
    	'cty_id',
		'card_sn',
		'card_pass',
		'status',
		'company_id',
		'token',
		'select_card_id',
		'user_name',
		'user_mobile',
		'user_address',
		'start_time',
		'end_time',
		'use_time',
		'create_time',
	];

    protected $rememberTokenName = '';

    protected $ability;

	protected $table = 'gift_cards';

	public $timestamps = false;

	/**
	 * 卡类型信息
	 * @author: colin
	 * @date: 2018/12/20 8:58
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function cardType()
	{
		return $this->hasOne(GiftCardType::class, 'id', 'cty_id');
	}

	/**
	 * 订单关联
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function order()
	{
		return $this->hasOne(GiftOrder::class, 'card_id', 'id');
	}

}
