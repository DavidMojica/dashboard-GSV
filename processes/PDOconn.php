<?php
    $dsn      = "mysql:host=localhost;dbname=gsv;charset=UTF8";
    $username = "root";
    $password = "";
    try{
        $pdo = new PDO($dsn, $username, $password);
        $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Error de conexion = ". $e->getMessage();
    }
?>