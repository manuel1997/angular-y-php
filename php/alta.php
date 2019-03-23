<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  

  $_POST = json_decode(file_get_contents('php://input'), true);
 
  
  require("conexion.php");
  $pdo=retornarConexion();

  $descripcion = $_POST['descripcione'];
  $precio = $_POST['precioe'];

  $params=$pdo->prepare("INSERT INTO articulos (descripcion, precio) VALUES(?,?)");


  if ($params->execute(array($descripcion,$precio))) {
    $vari = 1;
  }else{
    $vari = 2;
  }

  
  class Result {}

  $response = new Result();
  $response->resultado = $vari;
  $response->mensaje = 'datos agregados';
  $response->msj = 'error al agregar';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>