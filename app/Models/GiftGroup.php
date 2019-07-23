<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftGroup extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = [ 'name', 'price','gs_ids','status', 'create_time'];

    protected $rememberTokenName = '';

    protected $ability;
	protected $table = 'gift_group_goods';
	public $timestamps = false;

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
