<?php
require_once(__DIR__."/controllers/rol.php");
require_once(__DIR__."/controllers/privilegio.php");
include_once('views/header.php');
include_once('views/menu.php');

$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;

switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $rol->new($data);
            if ($cantidad) {
                $rol->flash('success', 'Registro dado de alta con exito');
                $data = $rol->get();
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                include('views/rol/index.php');
            }
        }else {
            include('views/rol/form.php');
        }
        break;
    case 'delete':
        $cantidad = $rol->delete($id);
        if ($cantidad) {
            $rol->flash('success', 'Registro eliminado con exito');
            $data = $rol->get();
            include('views/rol/index.php');
        }else {
            $rol->flash('danger', 'Algo fallo');
            $data = $rol->get();
            include('views/rol/index.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_rol'];
            $cantidad = $rol->edit($id, $data);
            if ($cantidad) {
                $rol->flash('success', 'Registro actualizaco con exito');
                $data = $rol->get();
                include('views/rol/index.php');
            } else {
                $rol->flas('danger', 'Algo fallo');
                $data = $rol->get();
                include('views/rol/index.php');
            }
        } else {
            $data = $rol->get($id);
            include('views/rol/form.php');
        }
        break;
    case 'privilegio':
        $data = $rol->get($id);
        $data_privilegio = $rol->getPrivilegio($id);
        include('views/rol/privilegio.php');
        break;
    case 'deleteprivilegio':
        $cantidad = $rol->deletePrivilegio($id, $id_privilegio);
        if ($cantidad) {
            $rol->flash('success', 'Registro eliminado con exito');
            $data = $rol->get($id);
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        } else {
            $rol->flash('danger', 'Algo fallo');
            $data = $rol->get($id);
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        }
        break;
    case 'newprivilegio':
        $data = $rol->get($id);
        $privilegios_asignados = $rol->getPrivilegio($id);
        $todos_los_privilegios = $privilegio->get();

        $privilegios_disponibles = array_filter($todos_los_privilegios, function($privilegio) use ($privilegios_asignados) {
            foreach ($privilegios_asignados as $asignado ) {
                if ($privilegio['id_privilegio'] == $asignado['id_privilegio']) {
                    return false;
                }
            }
            return true;
        });

        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $rol->newPrivilegio($id, $data2);
            if ($cantidad) {
                $rol->flash('success', 'Privilegio asignado con exito');
            } else {
                $rol->flash('danger', 'Algo fallo');
            }
            $data_privilegio = $rol->getPrivilegio($id);
            include('views/rol/privilegio.php');
        } else {
            include('views/rol/privilegio_form.php');
        }
        
        break;
    case 'get':
    default:
        $data = $rol->get();
        include('views/rol/index.php');
    break;
}

include_once('views/footer.php');
?>