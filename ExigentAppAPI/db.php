<?php
include 'define.php';
header('Access-Control-Allow-Origin: *');   
header("Access-Control-Allow-Credentials: true");  
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS'); 
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

class Database {

    var $link;
    var $errorLog = true;
    var $host;
    var $dbLogin;
    var $dbPassword;
    var $dbDatabase;
 
    function Database($host, $dbLogin, $dbPassword, $dbDatabase)
    {
       $this->host = $host;
       $this->dbLogin = $dbLogin;
       $this->dbPassword = $dbPassword;
       $this->dbDatabase = $dbDatabase;
    }
 
 
    function connect() {
       $host = $this->host;
       $dbLogin = $this->dbLogin;
       $dbPassword = $this->dbPassword;
       $dbDatabase = $this->dbDatabase;
 
       $link = mysqli_connect($host, $dbLogin, $dbPassword, $dbDatabase);
       if ($link) {
          $this->link = $link;
          return true;
       }
       else {
          $this->errorHandler();
          return false;
       }
    }
 
    function selectDb($dbName) {
       if (mysqli_select_db($this->link, $dbName)) {
          return true;
       }
       else {
          $this->errorHandler();
          return false;
       }
    }
 
    function errorHandler() {
       if ($this->errorLog) {
          echo (mysqli_error($this->link));
       }
    }
 
    function executeQry ($qry) {
       $result = mysqli_query($this->link, $qry);
       if ($result) {
          return $result;
       }
       else {
          $this->errorHandler();
          return false;
       }
    }
 
    function getARow($qry) {
      $result = $this->executeQry($qry);
      if ($result) {
         $record = mysqli_fetch_array($result);
      }
      else {
         $record = array();
      }

      return $record;
    }

    function getResults($qry,$keyfield=null) {
       $records = array();
       $i = 0;
       $result = $this->executeQry($qry);
       if ($result) {
          $reccnt = mysqli_num_rows($result);
          while ($i<$reccnt) {
              $res = mysqli_fetch_assoc($result);
              $key = $i;
              if ($keyfield!=null) 
                  $key = $res[$keyfield];
                  
              $records[$key] = $res;
              $i++;   
          }
       }
       else {
          $records = false;
       }
       return $records;
    }  
    
    function Create($table, $fields){
      if(is_array($fields)){
         foreach($fields as $key=>$val){
            $val = trim($val);
            if($val!=""){
               $keyList[]=$key;
               $values[]="'".mysqli_escape_string($this->link,$val)."'";
            }
         }
      }
      $keys=implode(",",$keyList);
      $vals=implode(",",$values);
      $qr="insert into $table(".$keys.") values(".$vals.")";
      if(!$this->executeQry($qr))
         return false;
      return true;
    }
 
    function getAllResults($qry) {
       $records = array();
       $i = 0;
       $result = $this->executeQry($qry);
       if ($result) {
          $reccnt = mysqli_num_rows($result);
          while ($i<$reccnt) {
             $records[$i++] = mysqli_fetch_array($result);
          }
       }
       else {
          $records = false;
       }
       return $records;
    }
 
    function getInsertedId() {
       return mysqli_insert_id($this->link);
    }

    function getCount($qry){
      $result = $this->executeQry($qry);
      if($result){
         $count = $result->fetch_assoc()['count_value']; //make sure Count() is refered as count_value
         return $count; 
      }
      return false;
    }
}

$db = new Database(HOST, USER, PWD, DB);
if(!$db->connect() || !$db->selectDb(DB)){
   echo json_encode(array("state"=>FAILURE));
   return;
}
?>