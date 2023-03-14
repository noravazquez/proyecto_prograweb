<?php
require_once('config.php');
class Sistema{
 var $db=null;
 public function db(){
    $dsn = DBDRIVER.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT;
    $this->db = new PDO($dsn,DBUSER,DBPASS);
 }
 public function flash($color, $msg){
   include('views/flash.php');
 }
}
?>