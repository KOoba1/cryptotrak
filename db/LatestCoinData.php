<?php
 header("Access-Control-Allow-Origin: *");
require('../../sql/connect_crypto.php');

$sql = "SELECT * 
FROM  `coinprice` 
WHERE entrydate = ( 
SELECT MAX( EntryDate ) 
FROM coinprice ) " ;


$queryResult = mysqli_query($conn, $sql) or die($conn->error);;
$rows = array() ; 


while($r = mysqli_fetch_assoc($queryResult)) {
    $rows[] = $r;
}


echo json_encode($rows); 

?>