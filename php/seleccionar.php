<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $pdo=retornarConexion();


  $codigo = $_GET['codigo'];

  $params=$pdo->prepare("SELECT * FROM articulos WHERE codigo = ?");
  $params->execute(array($codigo));


  echo json_encode($params->fetchAll());
  header('Content-Type: application/json');
?>