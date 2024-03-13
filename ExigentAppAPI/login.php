<?php
include_once("db.php");
extract($_POST);
$username = $_POST['username'];
$password = $_POST['password'];

$qry = "SELECT * FROM user WHERE UserName='$username' AND Password='$password'";
$res = $db->getARow($qry); 
if($res)
echo json_encode(array("state"=>1, "result"=>$res));
else
echo json_encode(array("state"=>0,));
?>