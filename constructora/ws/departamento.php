<?php
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/departamento.php');

$action = $_SERVER['REQUEST_METHOD'];
$id =  isset($_GET['id']) ?  $_GET['id'] : null;

switch($action){
    case 'DELETE':
        $data['mensaje']= 'No existe el departamento.';
        if (!is_null($id)) {
            $contador = $departamento->delete($id);
            if ($contador == 1) {
                $data['mensaje']= 'Se elimino el departamento.';
            }
        }
        break;
    case 'POST':
        $data = array();
        $data = $_POST['data'];
        if (is_null($id)) {
            $cantidad = $departamento->new($data);
            if ($cantidad !=0) {
                $data['mensaje']='Se inserto el departamento.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }else{
            $cantidad = $departamento->edit($id, $data);
            if ($cantidad !=0) {
                $data['mensaje']='Se modifico el departamento.';
                //$data[]
            }else{
                $data['mensaje']='Ocurrio un error';
            }
        }
        
        break;
    case 'GET':
    default:
        if (is_null($id)) {
            $data = $departamento->get();
        }else {
            $data = $departamento->get($id);
        }
        break;
}
$data = json_encode($data);
echo ($data);
?>