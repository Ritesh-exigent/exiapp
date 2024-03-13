<?php
    include_once("db.php");

    $data['id'] = $_POST['id'];
    $data['UserName'] = $_POST['userName'];
    $data['fromDate'] = $_POST['from'];
    $data['toDate'] = $_POST['to'];
    $data['days'] = $_POST['days'];
    $data['type'] = $_POST['type'];
    $data['reason'] = $_POST['reason'];
    $data['status'] = $_POST['status'];

    $from = $_POST['from'];
    $to = $_POST['to'];

    $qry = "SELECT *
    FROM leavelist
    WHERE ('$from'<= toDate AND '$to'>= fromDate)";
    $res = $db->getARow($qry);
    if($res)
    {
        echo json_encode(array("state"=>-1));
    }
    else if($db->Create("leavelist", $data)){
        echo json_encode(array("state"=>1));
    }
    else{
        echo json_encode(array("state"=>0));
    }
?>