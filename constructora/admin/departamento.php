<?php
require_once("controllers/departamento.php");
include_once('views/header.php');
include_once('views/menu.php');
include_once('views/footer.php');
$action = (isset($_GET['action']))?$_GET['action']:'get';
$id = (isset($_GET['id']))?$_GET['id']:null;
switch($action){
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $web->new($data);
            if ($cantidad) {
                $web->flash('success', "Registro dado de alta con éxito");
                $data = $web->get();
                include('views/departamento/index.php');
            }else{
                $web->flash('danger', "Algo fallo");
                include('views/departamento/form.php');
            }
        }else {
            include('views/departamento/form.php');
        }
        
    break;
    case 'edit':
        $data = $web->get($id);
        $cantidad= $web->edit($id,$data);
    break;
    case 'delete':
        $cantidad = $web->delete($id);
        if ($cantidad) {
            $web->flash('success', "Registro dado de alta con éxito");
            $data = $web->get();
            include('views/departamento/index.php');
        }else{
            $web->flash('danger', "Algo fallo");
            $data = $web->get();
            include('views/departamento/index.php');
        }
    break;
    case 'get':
    default:
        $data = $web->get($id);
        include("views/departamento/index.php");
}

?>