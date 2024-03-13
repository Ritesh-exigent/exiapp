<?php
include_once("db.php");
$sno = $_POST['sno'];
$qry = "DELETE FROM leavelist WHERE sno='$sno'";
$res = $db->executeQry($qry);
if ($res) {
    echo json_encode(array('state' => 1));
} else {
    echo json_encode(array('state' => 0));
}
?>