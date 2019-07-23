<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class GiftLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$token = $request->header("token") ?? '';
		$res = ['status' => -99,'data'=>'','message' => '未登录！'];
		if(empty($token)){
			return response()->json($res);
		}
		$sessionData = Cache::get('gift_token'.$token);
		if(!isset($sessionData['card_sn']) || !isset($sessionData['card_type_id']) || !isset($sessionData['card_type_status'])){
			return response()->json($res);
		}
		if($sessionData['card_type_status'] == 0){
			$res = ['status' => \Enum\EnumMain::HTTP_CODE_FAIL,'data'=>'','message' => '该类型卡暂时无法使用！'];
			return response()->json($res);
		}
		if (!empty($sessionData)) {
			$expiresAt = 60 * 24 * 30;
			Cache::put($token, $sessionData, $expiresAt);
		}
		$userInfo['cardInfo'] = $sessionData;
		$userInfo['card_sn'] = $sessionData['card_sn'];
		$userInfo['card_id'] = $sessionData['card_id'];
		$request->merge($userInfo);
		return $next($request);
    }
}
