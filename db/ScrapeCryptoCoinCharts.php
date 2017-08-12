<?php
//require('../../sql/connect_crypto.php');
require('/var/www/sql/connect_crypto.php');
//https://poloniex.com/public?command=returnTicker

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://api.cryptocoincharts.info/listCoins',
     CURLOPT_SSL_VERIFYPEER => false
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
$sql = "INSERT INTO CryptoCoinChartsData ( CoinName, CoinId , BitcoinPrice )  VALUES  " ; 
foreach ($responseArray as $coin) {

	$name = mysqli_real_escape_string( $conn, $coin['name'] )  ; 
	$price = $coin['price_btc'] ; 
	$id = mysqli_real_escape_string( $conn,  $coin['id'] ) ; 
	if ($name != '' && $price > 0  && $id != '' ) {
		$i++; 
		$sql .= "  ( '" . $name  ."' , '" . $id ."' , " . $price. " ) , " ; 
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