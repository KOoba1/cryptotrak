<?php

//https://poloniex.com/public?command=returnTicker

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://poloniex.com/public?command=returnTicker',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
//echo $resp; 


$responseArray = json_decode($resp, true);
//print_r($responseArray); 
//print_r($responseArray['BTC_BCN']) ;
//$storeArray = $responseArray['d']['Results']; 

foreach ($responseArray as $key => $value) {

	echo $key."<br>"; 

}

curl_close($curl);



?>