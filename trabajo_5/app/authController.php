<?php

    var_dump($_POST)

    if(isset($_POST['access'])){
        switch ($_POST['access']) {
            case 'access':
                $authController = new AuthController()
                $email = $_POST['correo'];
                $password = $_POST['contrasenna'];

                $authController -> $email, $password;

                break;
            
            default:
                # code...
                break;
        }
    }

    class AuthController{
        public function authenticate($email = null, $password = null){
        }
    }

?>