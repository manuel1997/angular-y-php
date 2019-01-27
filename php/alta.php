<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  

  $_POST = json_decode(file_get_contents('php://input'), true);
 
  
  require("conexion.php");
  $pdo=retornarConexion();

  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];

  $params=$pdo->prepare("INSERT INTO articulos (descripcion, precio) VALUES(?,?)");
  $params->execute(array($descripcion,$precio));

  
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos grabados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>