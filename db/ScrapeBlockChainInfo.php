<?php
require('../../sql/connect_crypto.php');
//https://blockchain.info/ticker

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://blockchain.info/ticker',
     CURLOPT_SSL_VERIFYPEER => false
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
//echo $resp; 
//echo curl_error($curl);

$responseArray = json_decode($resp, true);
//print_r($responseArray); 
//print_r($responseArray['BTC_BCN']) ;
//$storeArray = $responseArray['d']['Results']; 

//print_r($responseArray); 

$lastPrice =  $responseArray['USD']['last'] ; 

$sql = "INSERT INTO BitcoinPrice ( Currency, Value, Symbol  ) VALUES ( 'USD' , " . $lastPrice ." , '$' ) ; ";
//echo $sql ;
$queryResult = mysqli_query($conn, $sql) or die($conn->error);;



/*
foreach ($responseArray as $coin) {

	$name = $coin['name'] ; 
	$price = $coin['price_btc'] ; 
	$id = $coin['id'] ; 
	if ($name != '' && $price != 0  && $id != '' ) {
		$i++; 
		echo "<br>$i  $id   " . $coin['name'] ; 
	}
} */


curl_close($curl);



?>