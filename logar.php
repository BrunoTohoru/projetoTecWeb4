<?php
session_start();
require('conexao.php');
  $email = $_POST["email"];
  $senha = $_POST["senha"];
 // echo "$usuario </br>";
 // echo "$senha </br>";

 $sql = "SELECT * FROM tbusuario WHERE (email='$email' AND senha='$senha')";
 $resultado = mysqli_query($conexao, $sql);
 if (mysqli_num_rows($resultado)>0){
  $_SESSION['email']=$email;
  header('Location: principal.php');
  die();
 }else{
  session_destroy();
  header('Location: index.php');
  die();
 }
?>