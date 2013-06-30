<?php
/**
 * 公用的工具类
 *
 * @author zeroq
 */
class CommonHelper
{
	/**
	 * 得到当前得根域名
	 * @return type
	 */
	public static function getDomain() {
		if (isset($_SERVER['HTTP_HOST'])) {
			$domain = implode('.', array_slice(explode(".", strpos($_SERVER['HTTP_HOST'], ':') ? substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], ':')) : $_SERVER['HTTP_HOST']), -2, 2));
		} else {
			$domain = $_SERVER['HTTP_HOST'];
		}
		return $domain;
	}

	/**
	 * 生成一个UUID
	 * @return string
	 */
	public static function guid() {
		if (function_exists('com_create_guid')) {
			return com_create_guid();
		} else {
			mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45);
			$uuid = substr($charid, 0, 8) . $hyphen
					. substr($charid, 8, 4) . $hyphen
					. substr($charid, 12, 4) . $hyphen
					. substr($charid, 16, 4) . $hyphen
					. substr($charid, 20, 12);
			return $uuid;
		}
	}
}
