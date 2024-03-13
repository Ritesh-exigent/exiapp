<?php
include_once("db.php");

$number = $_POST['number'];

$qry = "SELECT * FROM user WHERE Number='$number'";
$res = $db->getARow($qry); 
if($res !== false)
echo json_encode(array("state"=>1, "result"=>$res));
else
echo json_encode(array("state"=>0,));

?>