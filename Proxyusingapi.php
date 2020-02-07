<?php

function checkProxy($ip){
		$contactEmail="someValidEmailAddress"; //you must change this to your own email address
		$timeout=5;
		$banOnProbability=0.99;
		
		//init and set cURL options
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_URL, "http://check.getipintel.net/check.php?ip=$ip&contact=$contactEmail");
		$response=curl_exec($ch);
		curl_close($ch);
		if ($response > $banOnProbability) {
				return true;
		} else {
			if ($response < 0 || strcmp($response, "") == 0 ) {

			}
				return false;
		}
}


$ip=$_SERVER['REMOTE_ADDR'];

if (checkProxy($ip)) {

	echo "It appears you're a Proxy / VPN / bad IP, Redirecting you to a page. <br />";
       //Set Refresh header using PHP
        header( "refresh:5;url=http://yoursite.com/ip.html" );/

}

?>
