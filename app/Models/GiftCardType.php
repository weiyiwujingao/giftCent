<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftCardType extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = ['name', 'price', 'gr_ids', 'is_online', 'company_id', 'status', 'start_time', 'end_time', 'create_time','use_count', 'card_count'];

    protected $rememberTokenName = '';

    protected $ability;

    protected $table = 'gift_card_type';
    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cats()
    {
        return $this->hasMany(GiftGoodCat::class, 'parent_id', 'id');
    }
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function ucard()
	{
		return $this->hasMany(GiftCard::class, 'cty_id', 'id');
	}
    /**
     * 公司信息
     * @author: colin
     * @date: 2018/12/20 8:58
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasone(GiftCompay::class, 'id', 'company_id');
    }
}
