<?php

zzhttps://poloniex.com/public?command=returnTicker
//require('../../sql/connect_crypto.php'); //use this locally 
require('/var/www/sql/connect_crypto.php'); //use this on server 
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

//
//foreach ($responseArray as $key => $value) {

//print_r($responseArray); 
//print_r($responseArray['BTC_BCN']) ;
//$storeArray = $responseArray['d']['Results']; 
$i = 0 ; 
$sql = "INSERT INTO PoloniexData (  CoinId , BitcoinPrice )  VALUES  " ; 

foreach ($responseArray as $key => $value) {


	$price = $value['last'] ; 
	$id = mysqli_real_escape_string( $conn,  $key ) ; 
	if ( $price > 0  && $id != '' ) {
		$i++; 
		$sql .= "  (  '" . $id ."' , " . $price. " ) , " ; 
		//echo "<br>$i  $id   " . $coin['name'] ; 
	}
//	if ($i == 1 ) {break ; }
}
$sql = rtrim($sql, ', ');
$sql .= "; " ; 

echo $sql ; 
/*
  id MEDIUMINT NOT NULL AUTO_INCREMENT,
  CoinName VARCHAR(200),
  CoinId INT, 
  BitcoinPrice DECIMAL(10,9) ,
  EntryDate  DATETIME DEFAULT CURRENT_TIMESTAMP, 


*/
$queryResult = mysqli_query($conn, $sql) or die($conn->error);;
curl_close($curl);



?>