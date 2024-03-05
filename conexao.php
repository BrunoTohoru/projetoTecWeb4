<?php
    /*
    $host="localhost";
    $user="id21382062_brunoshiotani";
    $senha="IFpr@2023*";
    $bancodedados="id21382062_ifpr";
    */
    $host="localhost";
    $user="root";
    $senha="";
    $bancodedados="dbProjeto";
    
    $conexao = mysqli_connect($host, $user, $senha, $bancodedados);
    
    if($conexao->connect_error) {
        die("Conexão falhou: " . $conexao -> connect_error);
    }
?>