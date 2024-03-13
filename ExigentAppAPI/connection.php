<?php 
    include 'define.php';
    header('Access-Control-Allow-Origin: *');   
    header("Access-Control-Allow-Credentials: true");  
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS'); 
    header('Access-Control-Max-Age: 1000');  
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

    $localhost = "172.16.0.142";
    $user = "root";
    $pwd = "test";
    $database = "exiapp";
    $db = new mysqli(HOST, USER, PWD, DB);//new mysqli($localhost, $user, $pwd, $database);