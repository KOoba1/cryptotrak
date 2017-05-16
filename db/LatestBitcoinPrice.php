<?php
 header("Access-Control-Allow-Origin: *");
require('../../sql/connect_crypto.php');

$sql = "SELECT Currency, Value, Symbol FROM bitcoinprice WHERE EntryDate = ( SELECT MAX(EntryDate) from bitcoinprice ) " ;


$queryResult = mysqli_query($conn, $sql) or die($conn->error);;
$rows = array() ; 


while($r = mysqli_fetch_assoc($queryResult)) {
    $rows[] = $r;
}


echo json_encode($rows); 

?>