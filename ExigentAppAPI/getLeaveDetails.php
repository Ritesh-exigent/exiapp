<?php
include_once('db.php');
$uid = $_POST['id'];

if($uid != "")
$qry = "SELECT * FROM leavelist WHERE id='$uid'";
else
$qry = "SELECT * FROM leavelist WHERE status='0'";
$res = $db->getAllResults($qry);
if($res && count($res)>0)
{   
    echo json_encode(array("state"=>1, "result"=>$res));
}
else{
    echo json_encode(array("state"=>0));
}
    

?>