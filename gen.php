<?php 

	require_once('phpseclib/Crypt/RSA.php');
	require_once('phpseclib/Math/BigInteger.php');

	$key_file = file_get_contents('RSA/super_mega_key_file_top_secret_in_the_world.pem');

	$rsa = new Crypt_RSA();
	$rsa->loadKey($key_file);

	$test = urlencode(chunk_split(base64_encode($rsa->encrypt('test'))));
	
	echo $test;

?>