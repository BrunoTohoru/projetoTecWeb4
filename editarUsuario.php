<?php
//1. conectar o BD
//host, usuário, senha, nome do BD
require_once('conexao.php');
$armazenamentoId;
$recado = null;
if (isset($_GET["id"])) {
  //2. preparar a SQL
  $armazenamentoId = $_GET["id"];
  $sql2 = "SELECT * FROM tbusuario WHERE (id='$armazenamentoId')";
  $resultado = mysqli_query($conexao, $sql2);
  $linha = mysqli_fetch_array($resultado);
  //var_dump($linha);
  
}

if (isset($_POST["alterar"])) {
  //2. preparar a SQL
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  $sql = "update tbusuario
    set nome =  '$nome',
        email = '$email',
        senha = '$senha'
    where id = " . $armazenamentoId;



  //3. executar no BD e SQL
  mysqli_query($conexao, $sql);


  //4. mostrar um mensagem de sucesso
  header('Location: principal.php');
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <form method="post">
      <div class="mb-3">
        <label for="n1" class="form-label">Alterar registro nº:</label>
        <input type="number" name="id" class="form-control" id="id" value="<?= $armazenamentoId ?>" disabled>
      </div>
      <div class="mb-3">
        <label for="n2" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" id="nome" value="<?= $linha['nome']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="n3" class="form-label">email</label>
        <input type="email" name="email" class="form-control" id="email" value="<?= $linha['email']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="n4" class="form-label">senha</label>
        <input type="password" name="senha" class="form-control" id="senha" value="<?= $linha['senha']; ?>" required>
      </div>
      <button type="submit" name="alterar" class="btn btn-primary"> Submit </button>
    </form>
    <br>
    <?php
    echo $recado
    ?>
  </div>
</body>

</html>