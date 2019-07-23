<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftOrder extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = ['order_id', 'order_sn', 'card_id', 'sel_gr_id', 'status', 'user_name', 'user_mobile', 'user_address', 'user_address_all', 'remark', 'create_time'];

    protected $rememberTokenName = '';

    protected $ability;

    protected $table = 'gift_order';

	protected $primaryKey = 'order_id';

    public $timestamps = false;



    /**
     * 卡信息
     * @author: colin
     * @date: 2018/12/20 17:21
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function card()
    {
        return $this->hasOne(GiftCard::class, 'id', 'card_id');
    }

    /**
     * 套餐信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function groupGoods()
    {
        return $this->hasOne(GiftGroup::class, 'id', 'sel_gr_id');
    }
	/**
	 * 物流信息
	 * @author: colin
	 * @date: 2018/12/21 14:33
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function express()
	{
		return $this->hasOne(GiftOrderExpress::class,'order_sn','order_sn');
	}

}
