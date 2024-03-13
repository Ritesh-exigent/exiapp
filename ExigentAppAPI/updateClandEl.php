<?php 
include_once("db.php");

$sno = $_POST['sno'];
$Cl = $_POST['Cl'];
$El = $_POST['El'];

$qry = "SELECT id, days, type FROM leavelist WHERE sno='$sno'";
$res = $db->getARow($qry);
if($res)
{   
    $nCl = $Cl;
    $nEl = $El;
    if($res['type'] == "Casual")
    {
        $nCl = (double)$Cl - (double)$res['days'];
        if($nCl < 0)
        $nCl = 0;
    }
    else {
        $nEl = (double)$El - (double)$res['days'];
        if($nEl < 0)
        $nEl = 0;
    }
    $id = $res['id'];
    $qry = "UPDATE user SET Casual='$nCl', Earned='$nEl' WHERE SNO='$id'";
    $res1 = $db->executeQry($qry);
    if($res1)
    {
        echo json_encode(array('state'=>1, 'CL'=>$nCl, 'EL'=>$nEl));
    }
    else{
        echo json_encode(array('state'=>0));
    }
}
else
    echo json_encode(array('state'=>0));

?>