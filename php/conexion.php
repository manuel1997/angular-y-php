<?php

function retornarConexion() {
    $link = 'mysql:host=localhost;dbname=bd1';
    $usuario = 'root';
    $password = 'admin';

    try {
        $pdo= new PDO($link, $usuario, $password);
       
        return $pdo;
   
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

?>