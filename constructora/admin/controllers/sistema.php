<?php
    require_once('config.php');
    class Sistema{
        var $db = null;
        public function db (){
            $connectionString = DBDRIVER.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT;
            $db = new PDO($connectionString, DBUSER, DBPASS);
        }

    }
?>