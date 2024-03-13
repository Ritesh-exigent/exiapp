<?php 
include_once("db.php");

$sno = $_POST['sno'];
$status = $_POST['status'];
if($status == "Approved")
$status = "1";
else
$status = "2";
$qry = "UPDATE leavelist SET status='$status' WHERE sno='$sno'";
$res = $db->executeQry($qry);
if($res)
    echo json_encode(array("state"=>1, "status"=>$status));
else
    echo json_encode(array("state"=>0));
?>