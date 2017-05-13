<?php
require('../../sql/connect_crypto.php');
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
$sql = "INSERT INTO CoinPrice ( CoinName, CoinId , BitcoinPrice )  VALUES  " ; 
foreach ($responseArray as $coin) {

	$name = mysql_real_escape_string($coin['name'] )  ; 
	$price = $coin['price_btc'] ; 
	$id = mysql_real_escape_string($coin['id'] ) ; 
	if ($name != '' && $price > 0  && $id != '' ) {
		$i++; 
		$sql .= "  ( '$name', '$id', $price ) , " ; 
		//echo "<br>$i  $id   " . $coin['name'] ; 
	}
//	if ($i == 1 ) {break ; }
}
$sql = rtrim($sql, ', ');
$sql .= "; " ; 
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