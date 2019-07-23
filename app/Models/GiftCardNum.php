<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftCardNum extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = [
    	'num',
	];

    protected $rememberTokenName = '';

    protected $ability;

	protected $table = 'gift_card_num';

	public $timestamps = false;


}
