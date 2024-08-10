<?php

$servername = "localhost";
$username = "root";
$password = "";


try{
//La variable "conn" permitirá crear una conexión con nnuestra BD.
//$conn = mysqli_connect('localhost','root','','imfca');

$pdo = new PDO("mysql:host=$servername;port=3306;dbname=imfca", $username, $password);


// Verificar si la conexión fue exitosa
//if (!$conn) {
  
  //echo "Error en la conexion a la base de datos: ";
  //exit();
//}

// Establecer la codificación de caracteres
//mysqli_set_charset($conn, "utf8");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}

?>