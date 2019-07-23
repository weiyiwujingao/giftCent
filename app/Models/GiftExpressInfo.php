<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftExpressInfo extends Model
{
    protected $fillable = [
    	'ex_sn',
    	'ex_name',
    	'ex_tel',
    	'enable',
    	'create_time',
	];

    protected $table = 'gift_express_info';

    public $timestamps = false;

    protected $primaryKey = 'ex_id';

    protected $dateFormat = 'U';
}
