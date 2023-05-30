<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
//include_once(__DIR__.'/../admin/controllers/departamento.php');
include_once(__DIR__.'/../admin/controllers/proyecto.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        
        break;
    case 'POST':
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $proyecto->get();
        }else {
            $data = $proyecto->get($id);
        }
        break;
}

$data = json_encode($data);
echo ($data);
?>