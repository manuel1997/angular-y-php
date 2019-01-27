<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $_POST = json_decode(file_get_contents('php://input'), true);
  
  require("conexion.php");
  $pdo=retornarConexion();



  $params=$pdo->prepare("update articulos set descripcion=:descripcion, precio=:precio where codigo=:codigo ");
$params->bindParam(':codigo', $_POST[codigo]);
$params->bindParam(':descripcion', $_POST[descripcion]);
$params->bindParam(':precio', $_POST[precio]);
$params->execute();


  
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos modificados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>