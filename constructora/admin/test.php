<?php
    require_once('config.php');
    $connectionString = DBDRIVER.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT;
    $db = new PDO($connectionString, DBUSER, DBPASS);
    $prep2 = $db->prepare("select * from departamento");
    $prep2->execute();
    $result = $prep2->fetchAll();
    print_r($result);
?>