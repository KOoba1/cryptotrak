<?php
require('../../../sql/connect_mtg.php');
//https://poloniex.com/public?command=returnTicker

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://api.cryptocoincharts.info/listCoins'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
//echo $resp; 


$responseArray = json_decode($resp, true);
//print_r($responseArray); 
//print_r($responseArray['BTC_BCN']) ;
//$storeArray = $responseArray['d']['Results']; 
$i = 0 ; 

foreach ($responseArray as $coin) {

	$name = $coin['name'] ; 
	$price = $coin['price_btc'] ; 
	$id = $coin['id'] ; 
	if ($name != '' && $price != 0  && $id != '' ) {
		$i++; 
		//echo "<br>$i  $id   " . $coin['name'] ; 
	}
}

curl_close($curl);



?>