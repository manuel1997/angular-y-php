<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $pdo=retornarConexion();


  $registros=$pdo->prepare("SELECT * FROM articulos");
  $registros->execute();


  foreach ($registros->fetchAll() as $resultado){

    $vec[]=$resultado;
  }

  
  $cad=json_encode($vec);
  echo $cad;
  header('Content-Type: application/json');
?>