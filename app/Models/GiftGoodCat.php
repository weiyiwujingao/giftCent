<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftGoodCat extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = ['name', 'parent_id', 'status'];

    protected $rememberTokenName = '';

    protected $ability;

	protected $table = 'gift_goods_cat';
	public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cats()
    {
        return $this->hasMany(GiftGoodCat::class,'parent_id','id');
    }

    /**
     * 判断某个路由当前登录管理员是否有权限访问
     * @param $route
     * @return bool true / false
     */
    public function hasRule($route)
    {
        /**获取当前用户的用户组*/
        if(in_array(1,$this->roles->pluck('id')->toArray()))
        {
            return true;
        }

        $rules = $this->getRules();

        return in_array($route, $rules);
    }
}
