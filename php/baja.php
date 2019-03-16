<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $pdo=retornarConexion();
 

  $codigo = $_GET['codigo'];

  $params=$pdo->prepare("DELETE FROM articulos WHERE codigo = ?");
  

  if ($params->execute(array($codigo))) {

    $vari = 1;
    
  }else{

    $vari = 2;
  }
 
  
  class Result {}

  $response = new Result();
  $response->resultado = $vari;
  $response->mensaje = 'articulo borrado';
  $response->msj = 'fallo';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>