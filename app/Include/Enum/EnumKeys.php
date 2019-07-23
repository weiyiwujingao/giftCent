<?php

namespace Enum;

final class EnumKeys
{
	/* 订单状态 */
	const   OS_UNCONFIRMED = 0; // 未发货
	const   OS_CONFIRMED = 1; // 已确认
	const   OS_SUCCESS = 2; // 已完成
	const   OS_INVALID = 3; // 取消

	/* 防刷次数设定 */
	const   CHECK_TRY_NUMS = 3;

	/* 图片域名 */
	const   IMG_MANIN_URL = 'http://mp.xfjb-test.cn';

}