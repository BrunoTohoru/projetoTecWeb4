<?php
//1. conectar o BD
//host, usuário, senha, nome do BD
require_once('conexao.php');
$recado = "";
//Exluir usuário
if (isset($_GET["id"])) {
    //2. preparar a SQL

    $sql = "delete from tbusuario where id = " . $_GET['id'];
    //3. executar no BD e SQL
    mysqli_query($conexao, $sql); // MUDAR AQUI O $SQL

    $recado = "<div class='alert alert-primary' role='alert'>
    Usuário deletado com sucesso.
    </div>";
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">

<!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }
    }
    </style>
</head>
<body>
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="img/voce-sabia.gif" width="60" height="50" class="me-2" viewBox="0 0 118 94" role="gif" loop=infinite ><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                    <span class="fs-4">Esse é um projeto avaliativo da matéria de TECWEB - 4º bimestre - 2º ano</span>
                </a>
            </header>

            <div class="p-5 mb-4 bg-light rounded-3">
                <!--<div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Custom jumbotron</h1>
                    <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
                    <button class="btn btn-primary btn-lg" type="button">Example button</button>
                </div>-->
                <div class="container">
                    <h3>Lista de Usuários:</h3>
                    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input name="pesquisar" type="search" class="form-control" placeholder="Aperte enter aqui para ver todos Usuários cadastrados." aria-label="Search">
                    </form>
                    <?php 
                    //Pesquisar
                    if (isset($_GET["pesquisar"])) {
                        $pesquisa = $_GET["pesquisar"];
                        
                        if($pesquisa == null or $pesquisa == ""){
                            $sql = "select * from tbusuario";
                            $resultado = mysqli_query($conexao, $sql);
                        } else {
                            $sql2 = "SELECT * FROM tbusuario WHERE (nome LIKE '%$pesquisa%') ORDER BY nome ASC";
                            $resultado = mysqli_query($conexao, $sql2);
                        }
                        
                    ?>
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php while ($linha = mysqli_fetch_array($resultado)) : ?>
                                <tr>
                                    <th>
                                        <?= $linha['id'] ?>
                                    </th>
                                    <td>
                                        <?= $linha['nome'] ?>
                                    </td>
                                    <td>
                                        <?= $linha['email'] ?>
                                    </td>
                                    <td>
                                        <a href="EditarUsuario.php?id=<?= $linha['id'] ?>" class="btn btn-outline-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a href="principal.php?id=<?= $linha['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Confirma Exclusão?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
            
                    <?php
                    //4. mostrar um mensagem de sucesso
                    echo $recado;
                    ?>
                    <?php } ?>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-12">
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h3>Cadastro de Usuário:</h3>
                        <form method="post">
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="Nome" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                É obrigatório inserir um nome válido.
                                </div>
                            </div>

                            </div>

                            <div class="col-md-6 mb-3">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email@exemplo.com" required>
                            <div class="invalid-feedback">
                                Por favor, insira um endereço de e-mail válido, para atualizações de entrega.
                            </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for="senha">Senha </label>
                            <input type="password" class="form-control" name="senha" id="senha" placeholder="" required>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label for="conf_senha">Confirmar Senha </label>
                            <input type="password" class="form-control" name="conf_senha" id="conf_senha" placeholder="" required>
                            </div>

                            <?php
                            if (isset($_POST["enviar"])) {
                            //2. preparar a SQL
                            if ($_POST["senha"] == $_POST["conf_senha"]) {
                                $nome = $_POST["nome"];
                                $senha = $_POST["senha"];
                                $email = $_POST["email"];
                                $resultado = mysqli_query($conexao, "select email from tbusuario where email = '{$email}'");
                                if (mysqli_num_rows($resultado) == 0) {

                                $sql = "insert into tbusuario (nome, email, senha)
                                                values ('$nome','$email', '$senha')";

                                //3. executar no BD e SQL
                                mysqli_query($conexao, $sql);

                                //4. mostrar um mensagem de sucesso
                                echo "<div class='alert alert-primary' role='alert'>
                                        Cadastro de usuário realizado com sucesso.
                                        </div>";
                                } else {
                                echo "<div class='alert alert-warning' role='alert'>
                                    E-mail já cadastrado.
                                    </div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning' role='alert'>
                                        As senhas precisam ser idênticas.
                                        </div>";
                            }
                            }
                            ?>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" name="enviar" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
                
            </div>

            <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021
            </footer>
        </div>
    </main>
</body>
</html>