<?php
    include('controllers/sistema.php');
    include('views/header.php');

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'login';

    switch($action){
        case 'logout':
            $sistema ->logout();
            include('views/login/index.php');
            break;
        case 'forgot':
            include('views/login/forgot.php');
            break;
        case 'recovery':
            $data=$_GET;
            if (isset($data['correo']) and isset($data['token'])) {
                if ($sistema->validateToken($data['correo'], $data['token'])) {
                    include_once('views/login/recovery.php');
                }else {
                    $sistema->flash('danger', 'El token expiro');
                    include_once('views/login/index.php');
                }
            }else {
                $sistema->flash('danger', 'URL no puede ser completada como la requirio');
                include('views/login/index.php');
            }
            break;
            case 'reset':
                $data=$_POST;
                if (isset($data['correo']) and isset($data['token']) and isset($data['contrasena'])) {
                    if ($sistema->validateToken($data['correo'], $data['token'])) {
                        if ($sistema->resetPassword($data['correo'], $data['token'], $data['contrasena'])) {
                            $sistema->flash('success', 'Contraseña restablecida con exito');
                            include_once('views/login/index.php');
                        }else {
                            $sistema->flash('warning', 'Contacta a soporte tecnico o vuelve a iniciar el proceso especificando su correo electronico');
                            include_once('views/login/forgot.php');
                        }
                    }else {
                        $sistema->flash('danger', 'El token expiro');
                        include('views/login/index.php');
                    }
                }else {
                    $sistema->flash('danger', 'URL no puede ser completada como la requirio');
                    include('views/login/index.php');
                }
                break;
        case 'send':
            if (isset($_POST['enviar'])) {
                $correo = $_POST['correo'];
                $cantidad = $sistema->loginSend($correo);
                if ($cantidad) {
                    $sistema->flash('success', "Si el correo existe y está en la base de datos se le enviará un correo para la recuperación");
                    //include('views/login/index.php');
                }else{
                    $sistema->flash('danger', 'Error');
                }
                include('views/login/index.php');
            }
            break;
        case 'login':
            default:
            if(isset($_POST['enviar'])){
                $data=$_POST;
                if($sistema -> login($data['correo'],$data['contrasena'])){
                    header("Location: index.php");
                }
            }
            include('views/login/index.php');
            break;        
    }
    include('views/footer.php');

    
?>