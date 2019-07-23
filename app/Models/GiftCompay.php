<?php

namespace App\Models;

use App\Models\Traits\RbacCheck;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GiftCompay extends Authenticatable
{
    use Notifiable;
    use RbacCheck;

    protected $fillable = [ 'name', 'en_name', 'status', 'create_time'];

    protected $rememberTokenName = '';

    protected $ability;

	protected $table = 'gift_company';

	public $timestamps = false;

}
