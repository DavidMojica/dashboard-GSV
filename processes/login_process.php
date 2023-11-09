<?php
    include("PDOconn.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        #Variables provenientes de Ajax en login.js
        $user      = trim($_POST['user']);
        $pass      = trim($_POST['pass']);
        #Variables de php
        $errors = [];
        $queryError = "error";
        $ban = false;

        #-----------Validaciones para cada campo--------------#
        #Campos vacíos.
        #Longitud.
        #Confirmar concordancia

        #Nombre
        if(empty($user)){
            $errors[] = "El campo de usuario es obligatorio. <br>";
        }
        else if(empty($pass)){
            $errors[] = "El campo contraseña es obligatorio <br>";
        }

        if(empty($errors)){
            $query = "SELECT * FROM tbl_usuario WHERE username = :username AND pass = :pass";
            $stmt = $pdo->prepare($query);
                $user = filter_input(INPUT_POST,"user", FILTER_SANITIZE_STRING);
                $pass = filter_input(INPUT_POST,"pass", FILTER_SANITIZE_STRING);
                $pass_hash = hash('sha256', $pass);



        }
    }
?>