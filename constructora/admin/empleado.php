<?php
require_once(__DIR__."/controllers/empleado.php");
require_once(__DIR__."/controllers/departamento.php");
include_once("views/header.php");
include_once("views/menu.php");

$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($action) {
    case 'new':
        $datadepartamentos = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $data['foto'] = $empleado->convImgToBlob("views/empleado/fotos/foto.png");
            $cantidad = $empleado->new($data);
            if ($cantidad) {
                $empleado->flash('success', "Registro dado de alta con  éxito");
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            }else {
                $empleado->flash('danger', "Algo fallo");
                include('views/empleado/form.php');
            }
        } else {
            include('views/empleado/form.php');
        }
        
        break;
    case 'tomarfoto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true)['data'];
            $cantidad = $empleado->tomarfoto($data['id_empleado'], $data['foto']);
            if ($cantidad > 0) {
              echo json_encode(['resultado' => 'ok']);
              $empleado->flash('success', "Foto guardada con exito");
              include('views/empleado/index.php');
            } else {
              echo json_encode(['resultado' => 'error']);
              $empleado->flash('danger', "Algo fallo");
              include('views/empleado/index.php');
            }
          } else {
            include('views/empleado/tomarfoto.php');
          }
        break;
    case 'get':
    default:
        $data = $empleado->get(null);
        include("views/empleado/index.php");
        break;
}
include_once("views/footer.php");
?>