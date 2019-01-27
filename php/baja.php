<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $pdo=retornarConexion();
 

  $codigo = $_GET['codigo'];

  $params=$pdo->prepare("DELETE FROM articulos WHERE codigo = ?");
  $params->execute(array($codigo));
 
  
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'articulo borrado';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>