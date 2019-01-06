<?php
//Keep all functions in one place for codereadibility//
function makeLinks($str) {
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$urls = array();
	$urlsToReplace = array();
	if(preg_match_all($reg_exUrl, $str, $urls)) {
		$numOfMatches = count($urls[0]);
		$numOfUrlsToReplace = 0;
		for($i=0; $i<$numOfMatches; $i++) {
			$alreadyAdded = false;
			$numOfUrlsToReplace = count($urlsToReplace);
			for($j=0; $j<$numOfUrlsToReplace; $j++) {
				if($urlsToReplace[$j] == $urls[0][$i]) {
					$alreadyAdded = true;
				}
			}
			if(!$alreadyAdded) {
				array_push($urlsToReplace, $urls[0][$i]);
			}
		}
		$numOfUrlsToReplace = count($urlsToReplace);
		for($i=0; $i<$numOfUrlsToReplace; $i++) {
			$str = str_replace($urlsToReplace[$i], "<a href=\"https://anonym.to/?".$urlsToReplace[$i]."\"target=\"_blank\">".$urlsToReplace[$i]."</a> ", $str);
		}
		return $str;
	} else {
		return $str;
	}
}
function swecrypt( $string, $action = 'e' ) {
    $secret_key = $saltKey;
    $secret_iv = 'h3yb4b3n1c3a55';
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 	if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 	return $output;
}









?>