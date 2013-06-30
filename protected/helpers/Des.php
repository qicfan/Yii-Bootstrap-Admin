<?php
class Des
{
	private static $key = "d85833c6fa21a04bd1493b028d017f9ed541fad5";

	public static function encrypt($encrypt) {
		$encrypt = self::pkcs5_pad($encrypt);
		$iv = @mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$passcrypt = @mcrypt_encrypt(MCRYPT_DES, self::$key, $encrypt, MCRYPT_MODE_ECB, $iv);

		return bin2hex($passcrypt);
	}

	public static function decrypt($decrypt) {
		$decoded = pack("H*", $decrypt);
		$iv = @mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$decrypted = @mcrypt_decrypt(MCRYPT_DES,self::$key, $decoded, MCRYPT_MODE_ECB, $iv);
		return self::pkcs5_unpad($decrypted);
	}

	public static function pkcs5_unpad($text)
	{
		$pad = ord($text{strlen($text)-1});

		if ($pad > strlen($text)) return $text;
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return $text;
		return substr($text, 0, -1 * $pad);
	}

	public static function pkcs5_pad($text)
	{
		$len = strlen($text);
		$mod = $len % 8;
		$pad = 8 - $mod;
		return $text.str_repeat(chr($pad),$pad);
	}

}
?>

