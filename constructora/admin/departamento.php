<?php
    require_once("controllers/departamento.php");
    include_once('views/header.php');
    include_once('views/menu.php');
    
    $departamento->validateRol('Administrador');

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    switch ($action) {
        case 'new':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $departamento->new($data);
                if ($cantidad) {
                    $departamento->flash('success', "Registro dado de alta con éxito");
                    $data = $departamento->get();
                    include('views/departamento/index.php');
                } else {
                    $departamento->flash('danger', "Algo fallo");
                    include('views/departamento/form.php');
                }
            } else {
                include('views/departamento/form.php');
            }
            break;
        case 'edit':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_departamento'];
                $cantidad = $departamento->edit($id, $data);
                if ($cantidad) {
                    $departamento->flash('success', "Registro actualizado con éxito");
                    $data = $departamento->get();
                    include('views/departamento/index.php');
                } else {
                    $departamento->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $departamento->get();
                    include('views/departamento/index.php');
                }
            } else {
                $data = $departamento->get($id);
                include('views/departamento/form.php');
            }
            break;
        case 'delete':
            $cantidad = $departamento->delete($id);
            if ($cantidad) {
                $departamento->flash('success', "Registro eliminado con éxito");
                $data = $departamento->get();
                include('views/departamento/index.php');
            } else {
                $departamento->flash('danger', "Algo fallo");
                $data = $departamento->get();
                include('views/departamento/index.php');
            }
            break;
        case 'get':
        default:
            $data = $departamento->get($id);
            include("views/departamento/index.php");
    }
    include_once('views/footer.php');
?>