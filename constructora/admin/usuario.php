<?php
    require_once(__DIR__."/controllers/usuario.php");
    require_once(__DIR__."/controllers/rol.php");
    include_once('views/header.php');
    include_once('views/menu.php');

    $action = (isset($_GET['action'])) ? $_GET['action'] : null;
    $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    $id_rol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;

    switch ($action) {
        case 'new':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $usuario->new($data);
                if ($cantidad) {
                    $usuario->flash('success', "Registro dado de alta con  éxito");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                }else {
                    $usuario->flash('danger', "Algo fallo");
                    include('views/usuario/index.php');
                }
            }else {
                include('views/usuario/form.php');
            }
        break;
        case 'delete':
            $cantidad = $usuario->delete($id);
            if ($cantidad) {
                $usuario->flash('success', "Registro eliminado con éxito");
                $data = $usuario->get(null);
                include('views/usuario/index.php');
            }else {
                $usuario->flash('danger', "Algo fallo");
                $data = $usuario->get(null);
                include('views/usuario/index.php');
            }
        break;
        case 'edit':
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $id = $_POST['data']['id_usuario'];
                $cantidad = $usuario->edit($id, $data);
                if ($cantidad) {
                    $usuario->flash('success', "Registro actualizado con  éxito");
                    $data = $usuario->get(null);
                    include('views/usuario/index.php');
                }else {
                    $usuario->flash('warning', "Algo fallo o no hubo cambios");
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                }
            }else {
                $data = $usuario->get($id);
                include('views/usuario/form.php');
            }
        break;
        case 'rol':
            $data = $usuario->get($id);
            $data_rol = $usuario->getRol($id);
            include('views/usuario/rol.php');
        break;
        case 'deleterol':
            $cantidad = $usuario->deleteRol($id, $id_rol);
            if ($cantidad) {
                $usuario->flash('success', 'Registro eliminado con exito');
                $data = $usuario->get($id);
                $data_rol = $usuario->getRol($id);
                include('views/usuario/rol.php');
            }else {
                $usuario->flash('danger', 'Algo fallo');
                $data = $usuario->get($id);
                $data_rol = $usuario->getRol($id);
                include('views/usuario/rol.php');
            }
        break;
        case 'newrol':
            $data = $usuario->get($id);
            $roles_asignados = $usuario->getRol($id);
            $todos_los_roles = $rol->get();

            $roles_disponibles = array_filter($todos_los_roles, function($rol) use ($roles_asignados) {
                foreach ($roles_asignados as $asignado) {
                    if ($rol['id_rol'] == $asignado['id_rol']) {
                        return false;
                    }
                }
                return true;
            });
            if (isset($_POST['enviar'])) {
                $data2 = $_POST['data'];
                $cantidad = $usuario->newRol($id, $data2);
                if ($cantidad) {
                    $usuario->flash('success', 'Rol asignado con exito');
                } else {
                    $usuario->flash('danger', 'Algo fallo');
                }
                $data_rol = $usuario->getRol($id);
                include('views/usuario/rol.php');
            } else {
                include('views/usuario/rol_form.php');
            }
        break;
        case 'get':
        default:
            $data = $usuario->get();
            include("views/usuario/index.php");
        break;
    }
    include_once('views/footer.php');
?>