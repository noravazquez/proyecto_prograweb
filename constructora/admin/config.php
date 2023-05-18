<?php
    //DATA BASE
    define("PATH", $_SERVER['DOCUMENT_ROOT'].'/prograweb1/proyecto_prograweb/constructora');
    define("DBDRIVER","mysql");
    define("DBHOST",'127.0.0.1');
    define("DBNAME","constructora");
    define("DBUSER","constructora");
    define("DBPASS","1234");
    define("DBPORT","3306");
    $uploads['archivo'] = array("application/gzip", "application/zip");
    $uploads['fotografia'] = array("image/jpeg", "image/png", "image/gif");
?>