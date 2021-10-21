<?php

	class AesCipher {
		public $returnValue = NULL;

		//key and init vector will be static for now
		//const $key = "0123456789abcdef";
		//$iv = NULL;

		public function __construct() { }

		private const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    	private const CIPHER_KEY_LEN = 16; //128 bits

    	private static function fixKey($key) {
        	if (strlen($key) < AesCipher::CIPHER_KEY_LEN) {
           		 return str_pad("$key", AesCipher::CIPHER_KEY_LEN, "0"); 
        	}
        	if (strlen($key) > AesCipher::CIPHER_KEY_LEN) {
            	return substr($key, 0, AesCipher::CIPHER_KEY_LEN); 
        	}
        	return $key;
    	}

    	static function encrypt($key, $iv, $data) {

        	$encodedEncryptedData = base64_encode(openssl_encrypt($data, AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, $iv));
        	$encodedIV = base64_encode($iv);
        	$encryptedPayload = $encodedEncryptedData.":".$encodedIV;

        	return $encryptedPayload;
    	}

    	static function decrypt($data) {
			$key = "0123456789abcdef";
        	$parts = explode(':', $data);
        	$encrypted = $parts[0];
        	$iv = $parts[1];
        	$decryptedData = openssl_decrypt(base64_decode($encrypted), AesCipher::OPENSSL_CIPHER_NAME, AesCipher::fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
        	return $decryptedData;
    	}
	}

?>
