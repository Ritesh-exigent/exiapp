<?php
include_once("db.php");
$number = $_POST['number'];

$qry = "SELECT Number FROM user WHERE Number='$number'";
if($db->executeQry($qry))
{
    echo json_encode(array('state'=>1));
}else{
    echo json_encode(array('state'=>0));
}
?>