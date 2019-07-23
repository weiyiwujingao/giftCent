<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SmsSendLog extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

	protected $fillable = [
		"user_id",
		"mobile_number",
		"content",
		"order_sn",
		"result",
		"create_time",
		"dfrom",
		"wx_send",
		"send_time",
		"remark",
	];

    protected $rememberTokenName = '';

    protected $ability;

	protected $table = 'sms_send_log';

    public $timestamps = false;

	protected $dateFormat = 'U';
}
