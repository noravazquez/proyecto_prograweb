<?php
    require_once('controllers/departamento.php');
    include_once('views/header.php');
    include_once('views/menu.php');
    include_once('views/footer.php');
    $accion = (isset($_GET['action']))?isset($_GET['action']):'getAll';
    switch($accion){
        case 'getAll':
        default:
            $data = $web->getAll();
            include("views/departamento/index.php");
            break;
    }
?>